<!-- User Membresia Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_membresia_id', 'User Membresia Id:') !!}
    <p>{{ $pagoMembresia->user_membresia_id }}</p>
</div>

<!-- Monto Field -->
<div class="col-sm-12">
    {!! Form::label('monto', 'Monto:') !!}
    <p>{{ $pagoMembresia->monto }}</p>
</div>

<!-- Fecha Pago Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_pago', 'Fecha Pago:') !!}
    <p>{{ $pagoMembresia->fecha_pago }}</p>
</div>

<!-- Metodo Pago Field -->
<div class="col-sm-12">
    {!! Form::label('metodo_pago', 'Metodo Pago:') !!}
    <p>{{ $pagoMembresia->metodo_pago }}</p>
</div>

<!-- Estado Field -->
<div class="col-sm-12">
    {!! Form::label('estado', 'Estado:') !!}
    <p>{{ $pagoMembresia->estado }}</p>
</div>

