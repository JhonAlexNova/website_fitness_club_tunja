<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Medicion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_medicion', 'Fecha Medicion:') !!}
    {!! Form::text('fecha_medicion', null, ['class' => 'form-control','id'=>'fecha_medicion']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_medicion').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Peso Field -->
<div class="form-group col-sm-6">
    {!! Form::label('peso', 'Peso:') !!}
    {!! Form::text('peso', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Talla Field -->
<div class="form-group col-sm-6">
    {!! Form::label('talla', 'Talla:') !!}
    {!! Form::text('talla', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Grasa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grasa', 'Grasa:') !!}
    {!! Form::text('grasa', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Musculo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('musculo', 'Musculo:') !!}
    {!! Form::text('musculo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Perimetro Abdominal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('perimetro_abdominal', 'Perimetro Abdominal:') !!}
    {!! Form::text('perimetro_abdominal', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>