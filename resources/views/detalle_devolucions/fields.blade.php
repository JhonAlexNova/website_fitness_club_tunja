<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<!-- Devolucion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('devolucion_id', 'Devolucion Id:') !!}
    {!! Form::number('devolucion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Producto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    {!! Form::number('producto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Unidades Devolucion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_unidades_devolucion', 'Cantidad Unidades Devolucion:') !!}
    {!! Form::number('cantidad_unidades_devolucion', null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Unit De Cambio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor_unit_de_cambio', 'Valor Unit De Cambio:') !!}
    {!! Form::number('valor_unit_de_cambio', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Devuelto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_devuelto', 'Total Devuelto:') !!}
    {!! Form::number('total_devuelto', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Ganancia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_ganancia', 'Total Ganancia:') !!}
    {!! Form::number('total_ganancia', null, ['class' => 'form-control']) !!}
</div>

<!-- Createt At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('createt_at', 'Createt At:') !!}
    {!! Form::text('createt_at', null, ['class' => 'form-control','id'=>'createt_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#createt_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush