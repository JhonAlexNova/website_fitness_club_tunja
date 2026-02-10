@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{url('css/stock.min.css')}}">
<style>
    .small-box.bg-morado {
    background: #673AB7;
}

.small-box.bg-morado p, .small-box.bg-morado h3 {
    color:#fff
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
                   <!--  <a class="btn btn-primary float-right"
                       href="{{ route('productos.create') }}">
                       <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                    </a> -->
                </div>
            </div>
        </div>
    </section>

    <section id="ventas-cierre">
                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-md-12 form-group">

                        
                            @if(!is_null($cierreHome) && is_null($cierreHome->fecha_fin) && is_null($cierreHome->cierre_caja))
                                <a href="#modalCerrarCaja" data-toggle='modal' style='margin-left:20px' class='btn btn-outline-success pull-right'>Cerrar caja</a>
                            @endif

                            @if(Auth::user()->rol()->tipo=='ADMIN' ||  Auth::user()->rol()->tipo=='SUPER_ADMIN')
                                <form action="estado-acceso?config_id={{$configGlobal->id}}" method='post'>
                                    @csrf
                                    <input type="hidden" name='estado' value='{{$configGlobal->acceso=="Desabilitado"?"Habilitado":"Desabilitado"}}'>
                                    <button class='btn btn-outline-primary pull-right' style='margin-left:10px'>{{$configGlobal->acceso=="Desabilitado"?"Habilitar acceso":"Desabilitar acceso"}}</button>
                                </form>
                            @endif
                            @if(is_null($cierreHome))
                                <a href="{{ url('abrir-dia') }}" class='btn btn-outline-success pull-right'>Abrir Dia</a>
                            @elseif(!is_null($cierreHome) && !is_null($cierreHome->cierre_caja) && !is_null($cierreHome->fecha_inicio) && is_null($cierreHome->fecha_fin))
                                <a href="#exampleModalLong" data-toggle='modal' class='btn btn-outline-success pull-right'>Cerrar Dia</a>
                            @elseif(!is_null($cierreHome->fecha_fin))
                                <a href="{{ url('abrir-dia') }}" class='btn btn-outline-success pull-right'>Abrir Dia</a>
                            @endif

                            
                        </div>
                    </div>
                </div>
        </section>

    

        <form action="{{ url('cerrar-dia') }}" method='POST'>
            @csrf('field_token')
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">validar información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">usuario</label>
                            <input type="email" class='form-control' name='email' placeholder='Ingresar email'>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Contraseña</label>
                            <input type="password" class='form-control' name='password'  placeholder='*************'>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Validar</button>
                </div>
                </div>
            </div>
            </div>
        </form>

<!-- Modal -->



    <section id="ventas-cierre">
                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-md-12 form-group">
                           
                        </div>
                    </div>
                </div>
        </section>
    

    <div class="content px-3">

        <style>
          i.ion.ion-bag {
                background: #8f1a25 !important;
                margin: -18px -12px 0 -2px;
                color: #fff;
                font-size: 20px !important;
                height: 100%;
                width: 116px;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .small-box .icon {
                display: block !important;
            }

            @media(max-width:767px){
                .small-box h3, .small-box p {
                    z-index: 5;
                    font-size: 21px;
                }
            }
        </style>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        <div class="clearfix"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>${{number_format($facturasCierre->sum('total') - $gastos->sum('valor'))}}</h3>  
                            <p><b>TOTAL VENTA  - <span class="bg-danger" style='padding:2px'>GASTOS</span></b></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag" > $ {{ number_format($gastos->sum('valor')) }} </i>
                        </div>
                      <!--   <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>


              

                @if(Auth::user()->rol()->tipo!='VENDEDOR')
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>${{number_format($ventas_semana->sum('total'))}} <sup style="font-size: 20px"></sup></h3>
                            <p>VENTAS SEMANA</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                      
                    </div>
                </div>

                
                
                <div class="col-lg-3 col-xs-12 col-md-6 col-lg-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3> ${{number_format($ventas_mes->sum('total'))}} </h3>
                            <p>VENTAS MES</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                       <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12 col-md-6 col-lg-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>${{ number_format($ventas_totales->sum('total')) }} </h3>
                            <p>VENTAS TOTALES</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                       <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>

                <!--  -->

                
                @endif

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3> ${{ number_format(  $totalDescuadre->sum('valor') ) }} <sup style="font-size: 20px"></sup></h3>
                            <p>DESCUADRE</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                      
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3> ${{ number_format(  $totalGanancia->sum('valor') ) }} <sup style="font-size: 20px"></sup></h3>
                            <p>GANANCIA</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                      
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="small-box bg-morado">
                        <div class="inner">
                            <h3> ${{ number_format(  $total_ventas_porteria->sum('valor') ) }} <sup style="font-size: 20px"></sup></h3>
                            <p>INGRESOS PORTERIA</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                      
                    </div>
                </div>



                

            </div>

            @if(Auth::user()->rol()->tipo!='VENDEDOR')
                <form action="" class='formFiltro'>
                    <div class="row">
                        <div class="col-md-6 col-lg-3 form-group">
                            <span>Fecha inicio</span>
                            <input type="date" name='fecha_inicio' value='{{$fecha_inicio}}' class='form-control'>
                        </div>
                        <div class="col-md-6 col-lg-3 form-group">
                            <span>Fecha fin</span>
                            <input type="date"  name='fecha_fin' value='{{$fecha_fin}}' class='form-control'>
                        </div>
                        
                        <div class="col-md-6 col-lg-3 form-group">
                            <span>Filtrar por cierre</span>
                            <select name="cierre_id" class='form-control' placeholder='Filtrar por cierre'>
                                <option value="">Seleccionar</option>
                                @foreach($cierres as $cierre_fecha)
                                    <option value="{{$cierre_fecha->id}}" @if($cierre_fecha->id == $cierre->id) selected @endif>{{$cierre_fecha->fecha_inicio}} - {{$cierre_fecha->fecha_fin}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3 form-group">
                            <button type='sumit' class='btn btn-primary' style='margin-top:23px'>Filtrar</button>
                        </div>
                    </div>
                </form>
                @endif



           
                <div class="row">
                    <div class="col-md-8 form-group">
                        <div id="columnchart_material" style="width: 100%; height: 400px;"></div>
                    </div>
                    <div class="col-md-4 form-group">
                        <div class="card">
                            <div class="card-body">
                                <table class='table table-bordered'>
                                    <thead>
                                      <tr>
                                        <td>Tipo</td> 
                                        <td>Valor</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> Total gastos</td>
                                            <td> ${{ number_format($gastos->sum('valor')) }} </td>
                                        </tr>

                                        @if($configGlobal->tipo_negocio_id==1)
                                            <tr>
                                                <td> Ingreso de chicos</td>
                                                <td> ${{ number_format($chicosXTotal->sum('valor')) }} </td>
                                            </tr>
                                        @endif

                                        
                                         @foreach($metodos_pago as $metodo)
                                            <tr>
                                                <td> {{ $metodo->tipo }} </td>
                                                <td> ${{ number_format($metodo->total) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


        

                <div class="card">
                    <div class="card-body">
                        
                        <table class='table table-bordered datatableSimple'>
                            <thead>
                                <tr>
                                    <td>Producto </td>
                                    <td>Cantidad </td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($ventas_totales_producto as $producto)
                                    <tr>
                                        <td> {{ $producto->nombre }} </td>
                                        <td> {{ $producto->total_productos }} </td>
                                        <td> {{ number_format($producto->total_ventas) }} </td>
                                        @php
                                            $total+=$producto->total_ventas;
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><b>Total venta</b></td>
                                    <td></td>
                                    <td>${{number_format($total)}}</td>
                                </tr>
                                @foreach($metodos_pago as $metodo)
                                    @if($metodo->total>0)
                                            <tr>
                                                <td><b>Total  {{ $metodo->tipo }}</b> </td>
                                                <td></td>
                                                <td> ${{ number_format($metodo->total) }} </td>
                                            </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td><b>Total descuadre</b></td>
                                    <td></td>
                                    <td>${{number_format($totalDescuadre->sum('valor'))}}</td>
                                </tr>

                                <tr>
                                    <td> <b>Total gastos</b> </td>
                                    <td></td>
                                    <td> ${{ number_format($gastos->sum('valor')) }} </td>
                                </tr>

                                <tr>
                                    <td> <b>Total efectivo</b> </td>
                                    <td></td>
                                    <td> ${{ number_format($total - $gastos->sum('valor') - $totalDescuadre->sum('valor') ) }} </td>
                                </tr>


                            </tfoot>
                        </table>

                        <div class="card-footer clearfix">
                            <div class="float-right">
                                
                            </div>
                        </div>
                    </div>

                </div>
    </div>


    <!--  -->


    
<!-- Modal -->
<form action="/cerrar-caja" method="POST">
    @csrf
    <div class="modal fade" id="modalCerrarCaja" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Inventario de Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nombre de Producto</th>
                    <th scope="col">Cantidad venta</th>
                    <th scope="col">Inventario Físico</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataHistorialProductosVendidos as $historialProducto)
                        <tr>
                            <td> <input type="hidden" name="producto_id[]" value="{{$historialProducto->producto->id}}">  {{ $historialProducto->producto->nombre }} </td>
                            <td> {{ $historialProducto->cantidad_ventas }} <!-- - {{ $historialProducto->cantidad_actual }} --> </td>
                            <td>
                                <input type="number" name="cantidad[]" required placeholder="Cantidad fisica">
                            </td>
                        </tr>
                    @endforeach
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
            </div>
        </div>
    </div>
</form>


<!--  -->



@endsection

@push('page_scripts')
<script>
    $(document).on('change','input[name=fecha_inicio]',function(e){
        var fecha_fin  = $('input[name=fecha_fin]').val('');
    });
    $(document).on('change','input[name=fecha_fin]',function(e){
        var fecha_inicio  = $('input[name=fecha_inicio]').val();

        if(fecha_inicio !='' && $(this).val()!=''){
            $.ajax({
                url:`/fechas_cierre?fecha_inicio=${fecha_inicio}&fecha_fin=${$(this).val()}`,
                method:'GET',
                success:function(response){
                    var htmlSelect  = ``;
                    $.each(response, function(e){
                        htmlSelect = `
                            <option value='${this.id}'> ${this.fecha_inicio} - ${this.fecha_fin} </option>
                        `;
                    });
                    $('select[name=cierre_id]').html(htmlSelect);
                }
            })
        }
    });
</script>
@endpush

