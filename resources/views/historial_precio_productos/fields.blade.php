<!-- Producto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    {!! Form::number('producto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::text('precio', null, ['class' => 'form-control','maxlength' => 32,'maxlength' => 32]) !!}
</div>

<!-- Fecha Actualizacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_actualizacion', 'Fecha Actualizacion:') !!}
    {!! Form::text('fecha_actualizacion', null, ['class' => 'form-control','id'=>'fecha_actualizacion']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_actualizacion').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush