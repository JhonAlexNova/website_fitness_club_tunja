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

                        @if($pagoMembresia->estado === 'APPROVED')
                            <span class="badge badge-success p-2" style="font-size: 1rem;">
                                <i class="fas fa-check-circle"></i> Membresía aprobada
                            </span>

                        @elseif($pagoMembresia->estado === 'REJECTED')
                            <span class="badge badge-danger p-2" style="font-size: 1rem;">
                                <i class="fas fa-times-circle"></i> Pago rechazado
                            </span>

                        @else
                            {{-- Botón Aprobar --}}
                            <form action="{{ route('pagoMembresias.aprobar', $pagoMembresia->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('¿Confirmas la aprobación de esta membresía?')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg mr-2">
                                    <i class="fas fa-check-circle"></i> Aprobar Membresía
                                </button>
                            </form>

                            {{-- Botón Rechazar --}}
                            <form action="{{ route('pagoMembresias.rechazar', $pagoMembresia->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('¿Seguro que deseas rechazar este pago? Esta acción desactivará la membresía del usuario.')">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-lg">
                                    <i class="fas fa-times-circle"></i> Rechazar Pago
                                </button>
                            </form>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection