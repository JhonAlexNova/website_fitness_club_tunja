@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gastos</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right {{is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja)?'disabled':''}}"
                       href="{{ route('gastos.create') }}">
                       <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
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
                            <span>Filtrar por cierre</span>
                            <select name="cierre_id" class='form-control' placeholder='Filtrar por cierre'>
                                @foreach($cierres_fechas as $cierre_fecha)
                                    <option value="{{$cierre_fecha->id}}" @if($cierre_fecha->id == $cierre_id) selected @endif>{{$cierre_fecha->fecha_inicio}} - {{$cierre_fecha->fecha_fin}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <button type='sumit' class='btn btn-primary' style='margin-top:23px'>Filtrar</button>
                        </div>
                    </div>
                </form>

                
                @include('gastos.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

