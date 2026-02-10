<!-- Caracteristica Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('caracteristica_id', 'Caracteristica Id:') !!}
    {!! Form::select('caracteristica_id', $caracteristicas->pluck("nombre","id"), null, ['class' => 'form-control',"placeholder"=>"Seleccionar","required"=>true]) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::text('valor', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>