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
           

                <form action="" class='formFiltro'>
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
                                    @foreach($cierres as $cierre)
                                        <option value="{{$cierre->id}}" @if(!is_null($cierre) && $cierre->id==$cierre_id) selected @endif >{{$cierre->fecha_inicio}} - {{$cierre->fecha_fin}}</option>
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
                                    <td>Ingreso al inventario</td>
                                    <td>Cantidad vendidas</td>
                                    <td>Cantidad Inicial en inventario</td>
                                    <td>Cantidad final en inventario</td>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($data as $index => $dt)
                                    <tr>
                                        <td>  {{ $index + 1}} </td>
                                        <td>  {{ $dt['producto']->nombre }} </td>
                                        <td>  {{ $dt['cantidad_ingresos'] }} </td>
                                        <td>  {{ $dt['cantidad_salidas'] }} </td>
                                        <td>  {{ $dt['cantidad_inicial'] }} </td>
                                        <td>  {{ $dt['cantidad_final'] }}   </td>
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
<script>
    $(document).on('change','input[name=fecha_inicio]',function(e){
        var fecha_fin  = $('input[name=fecha_fin]').val('');
    });
    $(document).on('change','input[name=fecha_fin]',function(e){
        var fecha_inicio  = $('input[name=fecha_inicio]').val();

        if(fecha_inicio !='' && $(this).val()!=''){
            $('.formFiltro').submit();
        }
    });
</script>
@endpush

