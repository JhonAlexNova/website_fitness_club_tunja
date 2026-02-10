@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Asistencia Empleados</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="#exampleModal" data-toggle='modal'>
                        Agregar Asistencia
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
                @include('asistencia_empleados.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    

    <!-- Modal -->
    {!! Form::open(['route' => 'asistenciaEmpleados.store']) !!}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asistencia empleados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Fecha</label>
                            <input type="date" class='form-control disabled' value="{{date('Y-m-d')}}" disabled readonly='true'>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Empleado</label>
                            <select name="empleado_id" class='form-control' required>
                                <option value="">Seleccionar</option>
                                @foreach($empleados as $empleado)
                                    <option value="{{$empleado->id}}">   {{ $empleado->primer_nombre }} {{ $empleado->primer_apellido }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar asistencia</button>
                </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}



@endsection

