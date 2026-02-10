 <!-- Precio Field -->
 {!! Form::model($producto, ['route' => ['productos.update', $producto->id], 'method' => 'patch','files'=>true,'id'=>'formEdit']) !!}
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-12">
                <div class="foto">
                    <img src="/storage/{{$producto->icono}}" class='img-producto' alt="">
                </div>
            </div>
            
            <div class="form-group col-sm-6">
                {!! Form::hidden('id', null, ['class' => 'form-control',  'required'=>true, 'disabled'=>true]) !!}
                {!! Form::label('precio', 'Precio:') !!}
                {!! Form::number('precio_venta', $producto->historial_precio->precio_venta, ['class' => 'form-control',  'required'=>true, 'disabled'=>true]) !!}
            </div>


             <!-- Categoria Id Field -->
             <div class="form-group col-sm-6">
                {!! Form::label('categoria_id', 'Nombre:') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control',  'required'=>true, 'disabled'=>true]) !!}
            </div>


            <!-- Categoria Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('categoria_id', 'Categoria:') !!}
                {!! Form::select('categoria_id', $categorias->pluck('nombre','id'), null, ['class' => 'form-control', 'required'=>true, 'disabled'=>true]) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('precio', 'Cantidad disponible:') !!}
                {!! Form::number('cantidad_disponible', $producto->historial_producto->cantidad_actual, ['class' => 'form-control',  'required'=>true,  'disabled'=>true]) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('precio', 'Cantidad:') !!}
                {!! Form::number('cantidad', null, ['class' => 'form-control cantidad_compra',  'required'=>true]) !!}
            </div>

            
            <div class="form-group col-sm-12">
               <button type='button' class='btn btn-primary btnAgregarProductoCarrito'>Agregar</button>
            </div>


        </div>
    </div>
{!! Form::close() !!}

 