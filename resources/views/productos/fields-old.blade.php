<div class="row">
    <div class="col-md-12">
        <h6>Información basica</h6>
        <hr>
    </div>
    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'required'=>true]) !!}
    </div>


    <!-- Precio Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('precio', 'Precio de venta (Opcional):') !!}
        {!! Form::number('precio_venta', null,['class' => 'form-control']) !!}
    </div>




    <!-- Precio Field -->
    {{--<div class="form-group col-sm-6">
        {!! Form::label('sku', 'SKU:') !!}
        {!! Form::text('sku', null, ['class' => 'form-control',  'required'=>true,  'onkeydown'=>"disableEnterKey(event)"]) !!}
    </div>--}}


    <!-- Categoria Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('categoria_id', 'Categoria:') !!}
        {!! Form::select('categoria_id', $subcategorias, null, ['class' => 'form-control select2', 'required' => true,"placeholder"=>"Seleccionar"]) !!}
    </div>

    <!-- Foto Perfil Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('foto_perfil', 'Foto principal:') !!} <small class="nota-input">Imagen recomendada 500x500px</small>
        {!! Form::file('file', ['class' => 'form-control']) !!}
    </div>

    <!-- Descripcion Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('descripcion', 'Descripcion:') !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control',  'required'=>true]) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('descripcion', 'Seleccionar caracteristicas:') !!}
        <ul>
                @foreach($caracteristicas as $caracteristica)
                    <li> 
                        <input type="checkbox" {{ in_array($caracteristica->id, $caracteristicasSeleccionadas)?"checked":"" }} name="caracteristicas_seleccionadas[]" value="{{$caracteristica->id}}"> {{ $caracteristica->nombre }} 
                        <div class="row" style="display:non">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <!--  <label>
                                        <input type="checkbox" class="caracteristica" data-target="#talla">
                                        {{ $caracteristica->nombre }}
                                    </label> -->
                                    <div id="talla" class="valores" style="display:non;">
                                        <div class="variaciones">
                                            <div class="row variacion">
                                                <div class="col-sm-4">
                                                    <label>Seleccionar:</label>
                                                    <select class="form-control" name="valores_caracteristica_{{$caracteristica->id}}[]">
                                                            <option value="">Seleccionar</option>
                                                            @foreach($caracteristica->valores_caracteristica as $valor)
                                                                <option value="{{$valor->id}}"> {{ $valor->valor }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                <div class="col-sm-4">
                                                    <label>Precio:</label>
                                                    <input type="text" class="form-control" name="precio_{{$caracteristica->id}}[]" placeholder="Ingrese el precio">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Stock inicial:</label>
                                                    <input type="number" class="form-control" name="stock_{{$caracteristica->id}}[]" placeholder="Ingrese el stock">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary agregar-variacion" style="margin-top: 10px;">Agregar otra variación de talla</button>
                                    </div>
                                </div>

                                <!-- Checkbox para otra característica -->
                                
                            </div>
                    </div>

                </li>
                @endforeach
        </ul>
       
    </div>
</div>


