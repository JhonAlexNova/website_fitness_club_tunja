@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{url('css/devoluciones.min.css')}}">
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Crear devolución</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'devolucions.store','id'=>'formBuscarProducto']) !!}

            <div class="card-body">

                <div class="row">
                    @include('devolucions.fields')
                </div>

                

            </div>

            {!! Form::close() !!}
        </div>

        <div class="card">
            <div class="card-body">
                <div  id='s-devolver-producto'>
                {!! Form::open(['route' => 'devolucions.store','id'=>'formGuardarDevolucion']) !!}
                    <div class="row">
                        {!! Form::hidden('tipo', null, ['class' => 'form-control',  'required'=>true]) !!}
                        {!! Form::hidden('producto_id', null, ['class' => 'form-control',  'required'=>true]) !!}
                        <!-- Categoria Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('nombre producto', 'Nombre:') !!}
                            {!! Form::text('nombre', null, ['class' => 'form-control',  'required'=>true, 'disabled'=>true]) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::hidden('id', null, ['class' => 'form-control',  'required'=>true, 'disabled'=>true]) !!}
                            {!! Form::label('precio', 'Precio venta:') !!}
                            {!! Form::number('precio_venta', null, ['class' => 'form-control',  'required'=>true, 'disabled'=>true]) !!}
                        </div>


                        <div class="form-group col-sm-6">
                            {!! Form::hidden('id', null, ['class' => 'form-control',  'required'=>true, 'disabled'=>true]) !!}
                            {!! Form::label('precio', 'Valor nueva entrada:') !!}
                            {!! Form::number('valor_unit_de_cambio', null, ['class' => 'form-control',  'required'=>true,'readonly'=>true]) !!}
                        </div>

                        <div class="form-group col-sm-6 input_x_producto">
                            {!! Form::label('precio', 'Producto cambio:') !!}
                            <select name="producto_cambio_id" class='form-control'>
                                <option value="">Seleccionar</option>
                                @foreach($productos as $producto)
                                    <option value="{{$producto->id}}"> {{ $producto->nombre }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('precio', 'Cantidad a devolver:') !!}
                            {!! Form::number('cantidad_unidades_devolucion', null, ['class' => 'form-control',  'required'=>true]) !!}
                        </div>

                       

                        <div class="form-group col-sm-6">
                            {!! Form::label('precio', 'Valor de la devolución:') !!}
                            {!! Form::text('dinero_devolucion', null, ['class' => 'form-control cantidad_compra',  'required'=>true, 'readonly'=>true]) !!}
                        </div>

                        <div class="form-group col-sm-6 input_x_producto">
                            {!! Form::label('precio', 'Dinero pendiente:') !!}
                            {!! Form::number('dinero_pendiente', null, ['class' => 'form-control cantidad_compra',  'required'=>true, 'readonly'=>true]) !!}
                        </div>

                        <div class="form-group col-sm-12"> <hr>
                            <button class='btn btn-primary' type='submit'>Devolver</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- div -->
   
@endsection

@push('page_scripts')
<script>
    var producto = {};
    var producto_x_cambio = {};
    var tipo = null;
    $(document).on('change','select[name=tipo]',function(e){
        var tipo = $(this).val();
        $("input[name=sku-search]").val('');
        $('#s-devolver-producto').hide();
        if(tipo=='X_DINERO'){
            tipo = 'X_DINERO';
            $('.input_x_producto').hide();
          
        }else if(tipo=='X_PRODUCTO'){
            tipo = 'tipo';
            $('.input_x_producto').show();
           $("input[name=sku-search]").focus();
        }

        //
        if(tipo!=''){
            $('input[name=sku-search]').attr('disabled',false);
            $("input[name=sku-search]").focus();
        }else{
            $('input[name=sku-search]').attr('disabled',true);
        }
    });


    $(document).on('change','select[name=producto_cambio_id]',async function(e){
       var producto_cambio_id = $(this).val();
       producto_x_cambio = await getProductoById(producto_cambio_id);
       valores_x_cambio_producto();
    });

    function valores_x_cambio_producto(){
        var valor_a_favor_cliente = limpiarNumero($('input[name=dinero_devolucion]').val());
       var dinero_pendiente = parseInt(producto_x_cambio.historial_precio.precio_venta) - parseInt(valor_a_favor_cliente);
       $('input[name=dinero_pendiente]').val(numberFormat(dinero_pendiente));
    }


    
  function getProductoById(id){
        return new Promise((resolve, reject)=>{
            $.ajax({
                url:`/productos/${id}`,
                method:'get',
                success:function(response){
                resolve(response);
                }
            });
        })
    }


    

    $(document).on('keyup','input[name=cantidad_unidades_devolucion], input[name=valor_unit_de_cambio]',function(e){
        var valor_producto = producto.historial_precio.precio_venta;
        var valor_x_cambio = limpiarNumero($('input[name=valor_unit_de_cambio]').val());
        var cantidad = limpiarNumero($('input[name=cantidad_unidades_devolucion]').val());
        var tipo = $('select[name=tipo]').val();
        var resultado = (parseInt(valor_producto) * parseInt(cantidad)) - (parseInt(valor_x_cambio) * parseInt(cantidad)); 
        $('input[name=dinero_devolucion]').val(numberFormat(resultado));

        if(tipo=='X_PRODUCTO'){
            valores_x_cambio_producto();
        }
    });

    $(document).on('submit','#formBuscarProducto',async function(e){
        e.preventDefault();
        var sku =  $('input[name=sku-search]').val();
        var tipo = $('select[name=tipo]').val();
        if(tipo==''){
            toastr.error('Seleccione el tipo de cambio','Advertencia');
            return false;
        }
        var data = await getProducto(sku);
        if(data['error']){
            toastr.error(data.error,'Advertencia');
            $('#s-devolver-producto').fadeOut(100);
        }else{
            producto = data.producto;
    
            $('input[name=precio_venta]').val(numberFormat(data.producto.historial_precio.precio_venta));
            $('input[name=valor_unit_de_cambio]').val(numberFormat(data.valor_ingreso_x_devolucion));
            $('input[name=nombre]').val(data.producto.nombre);
            $('input[name=producto_id]').val(data.producto.id);

            $(`select[name=producto_cambio_id] option[value='${data.producto.id}']`).attr('disabled',true);
            
            if(tipo!=null){
                $('#s-devolver-producto').fadeIn(500);
            }
    
        }
    });

    
function getProducto(sku){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/productos/sku/${sku}?type=json`,
            method:'get',
            success:function(response){
               resolve(response);
            }
        });
    })
}

$(document).on('change','select[name=tipo]',function(e){
    var tipo = $(this).val();
    $('input[name=tipo]').val(tipo);
})
</script>
@endpush