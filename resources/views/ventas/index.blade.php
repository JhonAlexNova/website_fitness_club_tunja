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
                    <h1>Ventas</h1>
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
                 <form id='formVender' action='post'>
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <input type="text" class='form-control sku-search'  placeholder='Ingresar codigo'>
                        </div>
                        <div class="col-md-5 form-group">
                            <select name="producto_id" class='form-control'>
                                <option value="">Seleccionar</option>
                                @foreach($productos as $producto)
                                    <option value="{{$producto->sku}}"> {{$producto->nombre}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                           <button class='btn btn-outline-primary btn-block' style='margin-top:1px'>Buscar</button>
                        </div>
                    </div>                            
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div  id='detalleProductoVenta'></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <table style='width:100%' class="table table-striped tableDetalles">
                            <thead>
                                <tr>
                                    <th>Referencia</th>
                                    <th>Producto</th>
                                    <th>Precio Unit.</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
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

                        <b>Total</b>
                        <span  style='font-size:25px; color:red' class="total"></span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    


@endsection

@push('page_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src='{{url("js/venta.min.js")}}'></script>
    <script>
        $(document).ready(function() {
            $('select[name=producto_id]').select2();
        });

        
    </script>
@endpush


