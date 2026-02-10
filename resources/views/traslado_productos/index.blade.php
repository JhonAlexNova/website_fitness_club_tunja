@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Traslado Productos</h1>
                </div>
               
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <div class="card-body">
                <form action="" id="formBuscarProducto">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Negocio destino</label>
                            <select name="negocio_destino_id" class="form-control">
                                <option value="">Seleccionar</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}"> {{ $empresa->razon_social }} </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Cod. Producto</label>
                            <input type="text" class="form-control sku-search"  >
                        </div>
                        <div class="col-md-4">
                            <label for=""></label>
                            <button class="btn btn-primary" type="submit" id="enviar" style="margin-top:32px">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Nombre Field -->
                    <!-- Foto Perfil Field -->
                    <!-- <div class="form-group col-sm-12">
                        <div class="foto">
                            <img src="" class='img-producto' alt="Imagen producto">
                        </div>
                    </div> -->


                    <div class="form-group col-sm-3">
                        {!! Form::label('nombre', 'Nombre:') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'disabled'=>true]) !!}
                    </div>

                    <div class="form-group col-sm-3">
                        {!! Form::label('cantidad', 'Cantidad actual:') !!}
                        {!! Form::number('cantidad_actual', null, ['class' => 'form-control', 'disabled'=>true]) !!}
                    </div>


                    <div class="form-group col-sm-3">
                        {!! Form::label('cantidad', 'Cantidad a mover:') !!}
                        {!! Form::number('cantidad_mover', null, ['class' => 'form-control input-mover']) !!}
                    </div>

                    <div class="col-md-3">
                            <label for=""></label>
                            <button class="btn btn-primary {{is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja)?'disabled':''}}" type="submit" id="btnAgregarProducto" style="margin-top:32px">Agregar</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{route('trasladoProductos.store')}}" method="post">
                    <input type="hidden" name="negocio_destino_id">
                    @csrf
                    <table class="table table-bordered table-striped" id="tableProductos">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Valor</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                       
                    </table>
                    <hr>
                        <button type="submit" class="btn btn-primary pull-right {{is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja)?'disabled':''}}">Enviar</button>
                </form>
                <hr>

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


@push("page_scripts")
<script src="{{url('js/producto.js')}}?id=1"></script>
<script>
    var carrito = [];
    var producto = {};

    if(sessionStorage.getItem('carrito-traslados')===null){
        carrito = [];
        llenarTablaCarrito();
    }else{
        carrito = JSON.parse(sessionStorage.getItem('carrito-traslados'));

        llenarTablaCarrito();
    }


function llenarTablaCarrito(){
    if(carrito.length==0){
		$('.btnFinalizar').attr('disabled',true);
	}else{
		$('.btnFinalizar').attr('disabled',false);
	}

	if ($.fn.DataTable.isDataTable('#tableProductos')) {
      
    }
	  $('#tableProductos').DataTable().destroy();


	var htmlTable = '';
	$.each(carrito, function(index, el){
		htmlTable+= `
			<tr>
                <td>  ${this.sku} </td>
				<td>  ${this.nombre} </td>
				<td>  
					${this.cantidad} 
					<input  type="number" value="${this.cantidad}" name="cantidad[]" class="input_cantidad_${index}" style="display:none"/>
                    <input  type="number" value="${this.id}" name="id[]" class="input_cantidad_${index}" style="display:none"/>
				</td>
				<td>  $${numberFormat(this.historial_precio.precio_venta)} </td>
				<td>  $${numberFormat(this.total)} </td>
				<td>  <i class="fa fa-trash" onclick="eliminar_plan_carrito(${index})" aria-hidden="true"></i>  </td>
			</tr>
		`;
	});


	$('#tableProductos tbody').html(htmlTable);
	$('.total').html('$'+numberFormat(setTotalCarrito()));
	
	 // Destruir DataTables existente
	


	$('#tableProductos').DataTable({
		responsive: true,
		dom: 'Bfrtip', 
		buttons: [
		  'excelHtml5'      
		],
		"language": {
			"url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
		}
  
	  }); 
}

function setTotalCarrito(){
	var total = 0;
	for(var el of carrito){
		total = parseInt(total) + parseInt(el.total);
	}

	return total;
}




//agregar producto a carrito
$(document).on('click','#btnAgregarProducto',function(response){

    
	
	var cantidad = $('input[name=cantidad_mover]').val();
	var cantidad_disponible = parseInt($('input[name=cantidad_actual]').val());


	if(cantidad==''){
		toastr.warning('Digite una cantidad validad','Advertencia',{progressBar:true});
		return false;
	}

	if(cantidad>cantidad_disponible){
		toastr.warning('La cantidad no puede superar al inventario disponible','Advertencia',{progressBar:true});
		return false;
	}


	
	var totalPlan = parseInt(cantidad) * parseInt(producto.historial_precio.precio_venta);

	producto.total = totalPlan;
	producto.cantidad = cantidad;


	var CarritoSearch = carrito.filter((obj)=>obj.id==producto.id);
	let index = carrito.findIndex(el=> el.id ==producto.id);

    console.log(carrito);
    console.log(producto);
	
	
	if(index=='-1'){
		carrito.push(producto);	
        toastr.success('Producto agregado correctamente','Advertencia',{progressBar:true});
	}else{
		carrito[index] = producto;
        toastr.success('Producto actualizado','Advertencia',{progressBar:true});
	}

	sessionStorage.setItem('carrito-traslados',JSON.stringify(carrito));

	llenarTablaCarrito();

	$('#detalleProductoVenta').html('');
	$(".sku-search").val('');
	$(".sku-search").focus();

	/*  */
/* 
	// Obtén la instancia actual de Select2
		var select2Instance = $('select[name=producto_id]').data('select2');

		// Destruye la instancia actual de Select2
		if (select2Instance) {
			select2Instance.destroy();
		}

		// Elimina todas las opciones seleccionadas previamente
		$('select[name=producto_id] option:selected').prop('selected', false);

		// Agregar una opción vacía al principio del select
		$('select[name=producto_id]').prepend('<option value=""></option>');

		// Inicializar nuevamente el select con Select2
		$('select[name=producto_id]').select2(); */



});

function setCarrito(){
	sessionStorage.setItem('carrito-traslados',JSON.stringify(carrito));
}

function eliminar_plan_carrito(index){
	carrito.splice(index, 1);
	setCarrito();
	llenarTablaCarrito();
}


    $(document).on('submit','#formBuscarProducto',async function(e){
        e.preventDefault();
        var sku = $('.sku-search').val();
        dataProducto = await getProducto(sku);
        producto = dataProducto.producto;
        $("input[name=nombre]").val(dataProducto.producto.nombre);
        $("input[name=cantidad_actual]").val(dataProducto.producto.historial_producto.cantidad_actual);
        $(".img-producto").attr("src","storage/"+dataProducto.producto.icono);
    });

    $(document).on("change","select[name=negocio_destino_id]",function(e){
        $("input[name=negocio_destino_id]").val($(this).val());
    });
</script>
@endpush
