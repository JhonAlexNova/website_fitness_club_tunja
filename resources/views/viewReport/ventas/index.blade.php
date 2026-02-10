@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{url('css/stock.min.css')}}">
@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ventas</h1>
                </div>
                <div class="col-sm-6">
                   <!--  <a class="btn btn-primary float-right"
                       href="{{ route('productos.create') }}">
                       <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                    </a> -->
                </div>
            </div>
        </div>
    </section>


    

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>
           

                <form action="">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <span>Fecha inicio</span>
                                <input type="date" name='fecha_inicio' value='{{$fecha_inicio}}' class='form-control'>
                            </div>
                            <div class="col-md-3 form-group">
                                <span>Fecha fin</span>
                                <input type="date"  name='fecha_fin' value='{{$fecha_fin}}' class='form-control'>
                            </div>
                            <div class="col-md-3 form-group">
                                <span>Por cierre</span>
                                <select name="cierre_id" class='form-control'>
                                    <option value="-99"></option>
                                    @foreach($fechas_cierres as $fecha)
                                        <option value="{{$fecha->id}}" @if($cierre_id==$fecha->id) selected @endif> {{ $fecha->fecha_inicio }} - {{ $fecha->fecha_fin }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <button type='sumit' class='btn btn-primary' style='margin-top:23px'>Filtrar</button>
                            </div>
                        </div>
                </form>

              


        

                <div class="card">
                    <div class="card-body">
                        
                        <table class='table table-bordered datatableSimple'>
                            <thead>
                                <tr>
                                    <td># </td>
                                    <td> Producto </td>
                                    <td>Cantidad </td>
                                    <td>Total </td>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($ventas_totales_producto as $index => $venta)
                                    <tr>
                                        <td> {{ $index+=1 }} </td>
                                        <td> {{ $venta->nombre }} </td>
                                        <td>  {{ $venta->total_productos }} </td>
                                        <td>${{ number_format($venta->total_ventas) }} </td>
                                    </tr>
                             
                                @endforeach
                            </tbody>
                        </table>

                        <div class="card-footer clearfix">
                            <div class="float-right">
                                
                            </div>
                        </div>
                    </div>

                </div>
    </div>



@endsection

@push('page_scripts')


@endpush

