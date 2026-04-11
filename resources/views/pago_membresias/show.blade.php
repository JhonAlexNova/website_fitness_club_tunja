@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalle Pago Membresía</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('pagoMembresias.index') }}">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('pago_membresias.show_fields')
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        @if($pagoMembresia->estado !== 'APPROVED')
                            <form action="{{ route('pagoMembresias.aprobar', $pagoMembresia->id) }}" method="POST"
                                  onsubmit="return confirm('¿Confirmas la aprobación de esta membresía?')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-check-circle"></i> Aprobar Membresía
                                </button>
                            </form>
                        @else
                            <span class="badge badge-success p-2" style="font-size: 1rem;">
                                <i class="fas fa-check-circle"></i> Membresía ya aprobada
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection