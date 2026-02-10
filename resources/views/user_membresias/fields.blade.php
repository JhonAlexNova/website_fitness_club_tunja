<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $clientes, null, ['class' => 'form-control']) !!}
</div>

<!-- Membresia Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('membresia_id', 'Membresia Id:') !!}
    {!! Form::select('membresia_id', $membresias, null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Inicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
    {!! Form::date('fecha_inicio', isset($userMembresia)?$userMembresia->fecha_inicio:null, ['class' => 'form-control','id'=>'fecha_inicio']) !!}
</div>



<!-- Fecha Vencimiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vencimiento', 'Fecha Vencimiento:') !!}
    {!! Form::date('fecha_vencimiento', isset($userMembresia)?$userMembresia->fecha_vencimiento:null, ['class' => 'form-control','id'=>'fecha_vencimiento']) !!}
</div>



<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::select('estado', ['activa' => 'Activa', 'expirada' => 'Expirada', 'pendiente' => 'Pendiente', 'suspendida' => 'Suspendida'], null, ['class' => 'form-control']) !!}
</div>