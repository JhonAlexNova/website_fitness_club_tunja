<!-- Clase Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clase_id', 'Clase Id:') !!}
    {!! Form::select('clase_id', $clases->pluck("nombre","id"),null, ['class' => 'form-control',"placeholder"=>"Seleccionar","required"=>true]) !!}
</div>

<!-- Instructor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('instructor_id', 'Instructor Id:') !!}
    {!! Form::select('instructor_id', $instructores, null, ['class' => 'form-control',"placeholder"=>"Seleccionar","required"=>true]) !!}
</div>

<!-- Fecha Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_hora', 'Fecha Hora:') !!}
    {!! Form::text('fecha_hora', null, ['class' => 'form-control','id'=>'fecha_hora']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_hora').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Cupo Maximo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cupo_maximo', 'Cupo Maximo:') !!}
    {!! Form::number('cupo_maximo', null, ['class' => 'form-control']) !!}
</div>

@if(Route::is('horarioClaseUnicas.edit'))
    <!-- Cupos Disponibles Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('cupos_disponibles', 'Cupos Disponibles:') !!}
        {!! Form::number('cupos_disponibles', null, ['class' => 'form-control','readonly'=>true]) !!}
    </div>
@endif