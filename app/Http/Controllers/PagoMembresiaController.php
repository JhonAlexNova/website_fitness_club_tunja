<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoMembresiaRequest;
use App\Http\Requests\UpdatePagoMembresiaRequest;
use App\Repositories\PagoMembresiaRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Factura;
use App\Models\UserMembresia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Response;

class PagoMembresiaController extends AppBaseController
{
    private $pagoMembresiaRepository;

    public function __construct(PagoMembresiaRepository $pagoMembresiaRepo)
    {
        $this->pagoMembresiaRepository = $pagoMembresiaRepo;
    }

    public function index(Request $request)
    {
        $pagoMembresias = Factura::with(['user', 'detalles.membresia'])
            ->where('tipo', 'membresia')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($factura) {
                return (object) [
                    'id'                => $factura->id,
                    'referencia'        => $factura->referencia,
                    'user_membresia_id' => optional($factura->user)->primer_nombre . ' ' . optional($factura->user)->primer_apellido,
                    'monto'             => '$' . number_format($factura->total, 0, ',', '.'),
                    'fecha_pago'        => $factura->created_at->format('d/m/Y H:i'),
                    'metodo_pago'       => strtoupper($factura->tipo_pago ?? '—'),
                    'estado'            => $factura->estado,
                    'comprobante'       => $factura->comprobante,
                    'membresia'         => optional($factura->detalles->first()?->membresia)->nombre ?? '—',
                ];
            });

        return view('pago_membresias.index')->with('pagoMembresias', $pagoMembresias);
    }

    public function create()
    {
        return view('pago_membresias.create');
    }

    public function store(CreatePagoMembresiaRequest $request)
    {
        $pagoMembresia = $this->pagoMembresiaRepository->create($request->all());
        Flash::success('Pago Membresia saved successfully.');
        return redirect(route('pagoMembresias.index'));
    }

    private function findFactura($id)
    {
        return Factura::with(['user', 'detalles.membresia'])
            ->where('tipo', 'membresia')
            ->find($id);
    }

    private function facturaToObject(Factura $factura): object
    {
        return (object) [
            'id'                => $factura->id,
            'referencia'        => $factura->referencia,
            'user_membresia_id' => optional($factura->user)->primer_nombre . ' ' . optional($factura->user)->primer_apellido,
            'monto'             => '$' . number_format($factura->total, 0, ',', '.'),
            'fecha_pago'        => $factura->created_at->format('d/m/Y H:i'),
            'metodo_pago'       => strtoupper($factura->tipo_pago ?? '—'),
            'estado'            => $factura->estado,
            'comprobante'       => $factura->comprobante,
            'membresia'         => optional($factura->detalles->first()?->membresia)->nombre ?? '—',
        ];
    }

    public function show($id)
    {
        $factura = $this->findFactura($id);

        if (empty($factura)) {
            Flash::error('Pago Membresia not found');
            return redirect(route('pagoMembresias.index'));
        }

        $pagoMembresia = $this->facturaToObject($factura);

        return view('pago_membresias.show')->with('pagoMembresia', $pagoMembresia);
    }

    public function edit($id)
    {
        $factura = $this->findFactura($id);

        if (empty($factura)) {
            Flash::error('Pago Membresia not found');
            return redirect(route('pagoMembresias.index'));
        }

        $pagoMembresia = $this->facturaToObject($factura);

        return view('pago_membresias.edit')->with('pagoMembresia', $pagoMembresia);
    }

    public function update($id, UpdatePagoMembresiaRequest $request)
    {
        $factura = $this->findFactura($id);

        if (empty($factura)) {
            Flash::error('Pago Membresia not found');
            return redirect(route('pagoMembresias.index'));
        }

        $factura->fill($request->only([
            'estado',
            'tipo_pago',
            'comprobante',
        ]));
        $factura->save();

        Flash::success('Pago Membresia updated successfully.');
        return redirect(route('pagoMembresias.index'));
    }

    public function destroy($id)
    {
        $factura = $this->findFactura($id);

        if (empty($factura)) {
            Flash::error('Pago Membresia not found');
            return redirect(route('pagoMembresias.index'));
        }

        $factura->delete();

        Flash::success('Pago Membresia deleted successfully.');
        return redirect(route('pagoMembresias.index'));
    }

    public function aprobar($id)
    {
        $factura = $this->findFactura($id);

        if (empty($factura)) {
            Flash::error('Pago Membresia not found');
            return redirect(route('pagoMembresias.index'));
        }

        if ($factura->estado === 'APPROVED') {
            Flash::warning('Este pago ya fue aprobado anteriormente.');
            return redirect(route('pagoMembresias.show', $id));
        }

        if ($factura->estado === 'REJECTED') {
            Flash::warning('Este pago fue rechazado, no se puede aprobar.');
            return redirect(route('pagoMembresias.show', $id));
        }

        $detalle   = $factura->detalles->first();
        $membresia = optional($detalle)->membresia;

        if (empty($membresia)) {
            Flash::error('No se encontró la membresía asociada a esta factura.');
            return redirect(route('pagoMembresias.show', $id));
        }

        $fechaInicio      = Carbon::today();
        $fechaVencimiento = $membresia->tipo_duracion === 'meses'
            ? $fechaInicio->copy()->addMonths($membresia->duracion)
            : $fechaInicio->copy()->addDays($membresia->duracion);

        UserMembresia::updateOrCreate(
            [
                'user_id'      => $factura->user_id,
                'membresia_id' => $membresia->id,
            ],
            [
                'fecha_inicio'      => $fechaInicio,
                'fecha_vencimiento' => $fechaVencimiento,
                'estado'            => 'activa',
            ]
        );

        $factura->estado = 'APPROVED';
        $factura->save();

        Flash::success('Membresía aprobada correctamente. El usuario ya tiene acceso.');
        return redirect(route('pagoMembresias.show', $id));
    }

    public function rechazar(Request $request, $id)
    {
        $factura = $this->findFactura($id);

        if (empty($factura)) {
            Flash::error('Pago Membresia not found');
            return redirect(route('pagoMembresias.index'));
        }

        if ($factura->estado === 'APPROVED') {
            Flash::warning('Este pago ya fue aprobado, no se puede rechazar.');
            return redirect(route('pagoMembresias.show', $id));
        }

        if ($factura->estado === 'REJECTED') {
            Flash::warning('Este pago ya fue rechazado anteriormente.');
            return redirect(route('pagoMembresias.show', $id));
        }

        // Si existía una UserMembresia activa asociada, desactivarla
        $detalle   = $factura->detalles->first();
        $membresia = optional($detalle)->membresia;

        if ($membresia) {
            UserMembresia::where('user_id', $factura->user_id)
                ->where('membresia_id', $membresia->id)
                ->where('estado', 'activa')
                ->update(['estado' => 'inactiva']);
        }

        $factura->estado = 'REJECTED';
        $factura->save();

        Flash::error('Pago rechazado. La membresía del usuario ha sido desactivada.');
        return redirect(route('pagoMembresias.show', $id));
    }
}