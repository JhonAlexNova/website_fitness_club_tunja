<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo devolución:') !!}
    {!! Form::select('tipo', $tipos->pluck('tipo','tipo'),null, ['class' => 'form-control', 'placeholder'=>'Seleccionar']) !!}
</div>

<div class="col-md-5 form-group">
    {!! Form::label('tipo', 'Codigo producto:') !!}
    <input type="text" class='form-control' name='sku-search'  placeholder='Ingresar codigo' disabled>
</div>

