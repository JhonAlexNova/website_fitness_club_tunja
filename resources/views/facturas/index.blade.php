@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Facturas</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('facturas.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('facturas.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
@include("facturas.modal-detalles")

@endsection

@push("page_scripts")
    <script>
        function abrirModalFactura(data) {
            //return false;

            document.getElementById('modalReferencia').textContent = data.referencia;
            document.getElementById('modalTipo').textContent = data.tipo;
            document.getElementById('modalTipoPago').textContent = data.tipo_pago;
            document.getElementById('modalValor').textContent = data.valor;
            document.getElementById('modalEstado').textContent = data.estado;
            document.getElementById('modalCliente').textContent = data.cliente;
            document.getElementById('modalFecha').textContent = data.fecha;
            if(data.comprobante_url){
                 $('#comprobanteImg').show();
                document.getElementById('comprobanteImg').src = "/storage/"+data.comprobante_url;
            }else{
                $('#comprobanteImg').hide();
            }
            document.getElementById('modalComentario').value = '';

            // Guardar ID temporal
            document.getElementById('btnAprobar').onclick = function () {
                enviarAccion(data.referencia, 'APPROVED');
            };
            document.getElementById('btnRechazar').onclick = function () {
                enviarAccion(data.referencia, 'REJECTED');
            };

            // Mostrar modal
            new bootstrap.Modal(document.getElementById('facturaModal')).show();
        }

        function enviarAccion(referencia, estado) {
            const comentario = document.getElementById('modalComentario').value;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/admon/cambiar-estado', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ referencia, estado, comentario })
            })
            .then(resp => resp.json())
            .then(resp => {
                alert(resp.message || 'Estado actualizado');
                //location.reload();
            })
            .catch(err => alert('Error al actualizar'));
        }
    </script>
@endpush