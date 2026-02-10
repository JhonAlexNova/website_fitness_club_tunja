<div class="card">
   <div class="card-body">
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
            {!! Form::number('precio_venta', null,['class' => 'form-control',"required"=>true]) !!}
         </div>
         <!-- Precio Field -->
         {{--
         <div class="form-group col-sm-6">
            {!! Form::label('sku', 'SKU:') !!}
            {!! Form::text('sku', null, ['class' => 'form-control',  'required'=>true,  'onkeydown'=>"disableEnterKey(event)"]) !!}
         </div>
         --}}
         <!-- Categoria Id Field -->
         <div class="form-group col-sm-6">
            {!! Form::label('categoria_id', 'Categoria:') !!}
            {!! Form::select('categoria_id', $categorias->pluck('nombre','id'), null, ['class' => 'form-control select2', 'required' => true,"placeholder"=>"Seleccionar"]) !!}
         </div>
         <!-- Foto Perfil Field -->
         <!-- Descripcion Field -->
         <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('descripcion', 'Descripcion:') !!}
            {!! Form::textarea('descripcion', null, ['class' => 'form-control', "id"=>"editor"]) !!}
         </div>
      </div>
   </div>
</div>

@if(Route::is("productos.edit"))
<div class="row">
   <div class="col-md-12">
      {!! Form::label('descripcion', 'Seleccionar variaciones:') !!}
     
      <div id="accordion">
             @foreach($caracteristicas as $index=> $caracteristica)
                <div class="card">
                    <div class="card-header" id="heading{{$index}}">
                    <h5 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="true" aria-controls="collapse{{$index}}">
                        <input type="checkbox" {{ in_array($caracteristica->id, $caracteristicasSeleccionadas)?"checked":"" }} name="caracteristicas_seleccionadas[]" value="{{$caracteristica->id}}"> {{ $caracteristica->nombre }} 
                        </button>
                    </h5>
                    </div>
                    <div id="collapse{{$index}}" class="collapse show-paramostrar collapse{{$caracteristica->id}}" data-id="{{$caracteristica->id}}" aria-labelledby="heading{{$index}}" data-parent="#accordion">
                        <div class="card-body">
                            
                            <div class="row" >
                              <div class="col-md-12 form-group">
                                 <a href="javascript:void(0);"  data-id="{{$caracteristica->id}}"  class="btnAddVariacion btn btn-sm btn-outline-primary float-right">Agregar {{ $caracteristica->nombre }}  </a>
                              </div>
                              <div class="col-md-12 form-group">
                                    <table class="table table-bordered table-striped">
                                          <thead>
                                                <tr>
                                                    <th>Variación</th>
                                                    <th>Precio venta</th>
                                                </tr>
                                          </thead>      
                                          <tbody>

                                          </tbody>
                                    </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        
         
         
      </div>
   </div>
</div>

@endif


@if(Route::is("productos.edit"))
<div class="card">
   <div class="card-body">
      <div class="row">

         <!-- Imagen de Portada -->
         <div class="col-md-4">
            <div class="form-group text-center">
               <input type="file" name="imagenPortada" id="imagenPortada" class="form-control-file d-none" accept="image/*" onchange="mostrarPortada(event)">
               <div id="portadaContainer" class="mb-4 d-flex align-items-center justify-content-center border rounded" style="width: 100%; height: 200px; cursor: pointer;" onclick="document.getElementById('imagenPortada').click();">
                  <!-- Aquí se carga la imagen de portada desde el backend -->
                  <img id="vistaPreviaPortada" src="{{ $producto->portada ? url('/storage', $producto->portada->url) : '#' }}" alt="Vista previa portada" class="img-fluid rounded" style="max-width: 100%; max-height: 100%; object-fit: cover; {{ $producto->portada ? '' : 'display: none;' }}">
                  <div id="placeholderPortada" class="text-center" style="color: #888; {{ $producto->portada ? 'display: none;' : '' }}">
                     <i class="fas fa-upload" style="font-size: 24px;"></i>
                     <p>Subir Imagen de Portada</p>
                  </div>
               </div>
            </div>
         </div>

         <!-- Galería de Imágenes -->
         <div class="col-md-8">
            <div id="galeriaContainer" class="row" style="gap: 5px;">
               <!-- Cargar imágenes de la galería desde el backend -->
               @foreach($producto->galeria as $imagen)
                  <div class="col-md-3 position-relative d-flex align-items-center justify-content-center border rounded" style="height: 120px;" data-id="{{ $imagen->id }}">
                     <img src="{{ url('storage', $imagen->url) }}" alt="Imagen de galería" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                     <button type="button" class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;" onclick="eliminarImagenGaleria(this)">X</button>
                  </div>
               @endforeach

               <!-- Cuadro de subida de imagen al final de la galería -->
               <div id="uploadPlaceholder" onclick="document.getElementById('imagenesGaleria').click();" class="col-md-3 d-flex align-items-center justify-content-center border rounded" style="height: 120px; cursor: pointer;">
                  <i class="fas fa-upload" style="font-size: 24px; color: #888;"></i>
                  <span style="margin-left: 5px; color: #888;">Subir Imagen</span>
               </div>
               <input type="file" name="imagenesGaleria[]" id="imagenesGaleria" class="form-control-file d-none" accept="image/*" multiple onchange="agregarImagenesGaleria(event)">
            </div>
         </div>

      </div>
   </div>
</div>

<!-- Campo oculto para los IDs de imágenes eliminadas -->
<input type="hidden" name="imagenesEliminadas" id="imagenesEliminadas" value="">

@endif




<!-- agregar caracteristica producto -->

<!-- Button trigger modal -->

<!-- Modal -->
@if(Route::is("productos.edit"))
<div class="modal fade" id="modalNewVariacionProducto" tabindex="-1" aria-labelledby="modalNewVariacionProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNewVariacionProductoLabel">Seleccionar variación producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <input type="hidden" name="caracteristica_id" value="">
         <div class="row">
            
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary enviarVariacion" >Guardar</button>
      </div>
    </div>
  </div>
</div>
@endif
