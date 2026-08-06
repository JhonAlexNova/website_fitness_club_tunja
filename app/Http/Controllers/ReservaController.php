<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reserva;

use App\Models\ClaseRecurrente;
use App\Models\HorarioClaseUnica;

use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\Producto;
use App\Models\CoffeeProduct;

use Carbon\Carbon;
use Flash;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $reservasUnicas = Reserva::groupBy("horario_clase_id")->where("tipo_clase","unica")->get();
        $reservasRecurrentes = Reserva::groupBy("fecha_reserva")->where("tipo_clase","recurrente")->get();

        $reservas = array_merge($reservasUnicas->toArray(), $reservasRecurrentes->toArray());

        $reservas = collect($reservas);

        $data = [];
        foreach($reservasRecurrentes as $reserva){
            $horario_clase =  ClaseRecurrente::with(["clase","instructor"])->find($reserva->horario_clase_id);
            $inscritos = Reserva::where("fecha_reserva",$reserva->fecha_reserva)->select("id")->get()->count();
            $reserva["horario_clase"] = $horario_clase;
            $reserva["inscritos"] = $inscritos;
            $data[] = $reserva; 
        }
        

        $backpack = [
            "reservas_clase" => $data
        ];

        return view("admin.reservas.index", $backpack);
    }


    public function inscritos_clase(Request $request){
        $reservas = Reserva::with("cliente")
            ->where("fecha_reserva",$request->fecha_reserva)
            ->select("cliente_id","id","estado","created_at","horario_clase_id")
            ->get();

        // ── Agregamos los productos adicionales de cada reserva ──────────
        $reservas = $reservas->map(function ($reserva) {
            $reserva->productos_adicionales = $this->getProductosDeReserva($reserva);
            return $reserva;
        });

        $backpack = [
            "reservas" => $reservas
        ];
        return view("admin.reservas.table-inscritos-clase",$backpack);
    }

    /**
     * Busca, para una reserva dada, la factura del cliente que contenga
     * un detalle con ese mismo horario_clase_id (clase_id) y devuelve
     * los productos (producto_id) que vengan en esa misma factura.
     *
     * @param  Reserva $reserva
     * @return \Illuminate\Support\Collection  [ ['nombre' => ..., 'cantidad' => ...], ... ]
     */
    private function getProductosDeReserva($reserva)
    {
        // Buscamos el detalle de tipo "servicio" (inscripción a la clase)
        // que corresponde a esta reserva, para obtener el factura_id.
        $detalleClase = DetalleFactura::where("clase_id", $reserva->horario_clase_id)
            ->whereHas("factura", function ($q) use ($reserva) {
                $q->where("user_id", $reserva->cliente_id);
            })
            ->orderBy("created_at", "desc")
            ->first();

        if (empty($detalleClase)) {
            return collect();
        }

        // Traemos los demás detalles de esa misma factura que tengan producto_id
        $detallesProductos = DetalleFactura::where("factura_id", $detalleClase->factura_id)
            ->whereNotNull("producto_id")
            ->get();

        return $detallesProductos->map(function ($detalle) {
            // El producto_id puede pertenecer a la tabla "productos" (tienda)
            // o a "coffee_products" (coffee shop), según cómo se guardó la venta.
            $producto = Producto::find($detalle->producto_id);
            $nombre = $producto ? $producto->nombre : null;

            if (!$nombre) {
                $coffeeProducto = CoffeeProduct::find($detalle->producto_id);
                $nombre = $coffeeProducto ? $coffeeProducto->nombre : "Producto eliminado";
            }

            return [
                "nombre"   => $nombre,
                "cantidad" => $detalle->cantidad,
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        if ($request->tipo == "unica") {

            $clase = HorarioClaseUnica::findOrFail($request->horario_clase_id);

            $reservas = Reserva::where("horario_clase_id", $clase->id)
                ->where("tipo_clase", "unica")
                ->where("estado", "Reservada")
                ->count();

            if ($reservas >= $clase->cupo_maximo) {
                Flash::error("Esta clase ya está llena.");
                return redirect()->back();
            }

        } else {

            $clase = ClaseRecurrente::findOrFail($request->horario_clase_id);

            $reservas = Reserva::where("horario_clase_id", $clase->id)
                ->where("tipo_clase", "recurrente")
                ->where("estado", "Reservada")
                ->whereDate(
                    "fecha_reserva",
                    Carbon::parse($request->fecha_reserva)->format("Y-m-d")
                )
                ->count();

            if ($reservas >= $clase->cupo_maximo) {
                Flash::error("Esta clase ya está llena.");
                return redirect()->back();
            }

        }

        // 👇 Si pasa la validación, aquí guardas la reserva

        Reserva::create([
            "cliente_id" => auth()->id(),
            "horario_clase_id" => $request->horario_clase_id,
            "tipo_clase" => $request->tipo,
            "fecha_reserva" => $request->fecha_reserva ?? null,
            "estado" => "Reservada"
        ]);

        Flash::success("Reserva realizada correctamente");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}