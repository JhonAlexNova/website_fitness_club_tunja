<!-- User Membresia Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_membresia_id', 'User Membresia Id:') !!}
    {!! Form::number('user_membresia_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Pago Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_pago', 'Fecha Pago:') !!}
    {!! Form::text('fecha_pago', null, ['class' => 'form-control','id'=>'fecha_pago']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_pago').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Metodo Pago Field -->
<div class="form-group col-sm-6">
    {!! Form::label('metodo_pago', 'Metodo Pago:') !!}
    {!! Form::text('metodo_pago', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::text('estado', null, ['class' => 'form-control']) !!}
</div>