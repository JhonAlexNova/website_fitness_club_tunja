@extends('layouts.app')

@push('page_css')
    <link rel="stylesheet" href="{{url('css/ventas.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        input.form-control.cantidad_compra {
            padding: 28px;
            font-size: 43px;
        }
        
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cambios productos</h1>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-3">
                        <form id='formProductoIngreso' action='post'>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class='form-control sku-search'  placeholder='Producto entrada'>
                                </div>
                            </div>                            
                        </form>
                    </div>
                    <!--  -->

                    <div class="col-md-3">
                        <form id='formProductoSalida' action='post'>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class='form-control sku-search'  placeholder='Producto salida'>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div  id='detalleProductoIngreso'>
                            @include("cambios-x-producto.detalle-producto")
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div  id='detalleProductoSalida'>
                            @include("cambios-x-producto.detalle-producto-salida")
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <table style='width:100%' class="table table-striped tableDetalles">
                            <thead>
                                <tr>
                                    <th> Tipo </th>
                                    <th>Referencia</th>
                                    <th>Producto</th>
                                    <th>Precio Venta</th>
                                    <th>Cantidad</th>
                                    <th>Valor de cambio</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <tfoot>
                            
                            <tr>
                                <td colspan='7'>
                                    <button class='btn btn-primary pull-right btnFinalizar' disabled>Finalizar</button>
                                </td>
                            </tr>
                           
                        </tfoot>
                        <br>
                        <br>
                        <hr>

                      

                    </div>
                </div>
            </div>
        </div>
    </div>
    


@endsection

@push('page_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src='{{url("js/cambios-xproducto.js?id=38")}}'></script>
    <script>
        $(document).ready(function() {
            $('select[name=producto_id]').select2();
        });    
    </script>
@endpush


