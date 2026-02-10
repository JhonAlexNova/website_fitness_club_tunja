var producto = {};

$(".sku-search").focus();








$(document).on('change', 'select[name=producto_id]', async function(e) {
	var sku = e.target.value;
	$('.sku-search').val(sku);
	var productoHtmlDetalles = await getProducto(sku);
	$('#detalleProductoVenta').html(productoHtmlDetalles);

	var productoHtmlDetalles = await getProducto(sku);
    $('#detalleProductoVenta').html(productoHtmlDetalles);
    var producto_id = $('input[name=id]').val();

    if (typeof producto_id !== 'undefined') {
     	producto = await getProductoById(producto_id);
    }
});



$(document).on('submit','#formVender',async function(e){
	e.preventDefault();
	var sku = $('.sku-search').val();
	console.log(sku);
    var productoHtmlDetalles = await getProducto(sku);
    $('#detalleProductoVenta').html(productoHtmlDetalles);
    var producto_id = $('input[name=id]').val();

    if (typeof producto_id !== 'undefined') {
       producto = await getProductoById(producto_id);
    }
});


  function get_total_carrito(){
	var total = 0;
	for(var elemento of carrito){
		total += parseInt(elemento.total);
	}
	return total;
  }




$(document).on('click', '.btnFinalizar', async function(e) {
	var csrf_token = $('meta[name="csrf-token"]').attr('content');

	var data = {
		carrito: carrito,
		_token: csrf_token,
		total:get_total_carrito()
	};

	$(".btnFinalizar").attr("disabled",true);

	// Envía la solicitud AJAX
	$.ajax({
		url: '/facturas', // Cambia esta URL a la ruta correcta en tu aplicación
		type: 'POST',
		data: data,
		success: function(response) {
			sessionStorage.removeItem('carrito');
			toastr.success('Venta realizada correctamente','Mensaje');
			setTimeout(()=>{
				location.reload();
			},1000)
		},
		error: function(error) {
			// Maneja los errores
			console.error('Error al guardar', error);
		}
	});
});

  



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



function getProducto(sku){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/productos/sku/${sku}`,
            method:'get',
            success:function(response){
               resolve(response);
            }
        });
    })
}

/* CARRRITO DE COMPRAS */
var carrito = [];

const urlDominio = location.href;
const urlObj = new URL(urlDominio);
const queryParams = urlObj.searchParams;

var API_WOMPI_URL = 'https://sandbox.wompi.co/v1/';




if(sessionStorage.getItem('carrito')===null){
	carrito = [];
	llenarTablaCarrito();
}else{
	carrito = JSON.parse(sessionStorage.getItem('carrito'));

	llenarTablaCarrito();
}

var totalCarrito = 0;





function showMessages(ms){
	Swal.fire({
	  icon: ms.icon,
	  title:'Mensaje',
	  text: ms.text,
	  showDenyButton: false,
	  showCancelButton: true,
	  confirmButton:false,
	  denyButtonText: `Aceptar`,
	}).then((result) => {
	  
	})
}


//agregar producto a carrito
$(document).on('click','.btnAgregarProductoCarrito',function(response){
	
	var cantidad = $('#modalDetailsProduct input[name=cantidad]').val();
	var cantidad_disponible = producto.historial_producto.cantidad_actual;


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
	
	
	if(index=='-1'){
		carrito.push(producto);	
        toastr.success('Producto agregado correctamente','Advertencia',{progressBar:true});
	}else{
		carrito[index] = producto;
        toastr.success('Producto actualizado','Advertencia',{progressBar:true});
	}

	sessionStorage.setItem('carrito',JSON.stringify(carrito));


	$('#modalDetailsProduct').modal('hide');

	llenarTablaCarrito();
});


function modificarProductoCarrito(params){
	var producto_id = params.producto_id;
	var cantidad = params.cantidad;

	//var plan = planes.filter((obj)=>obj.id==id_plan).shift();
	var totaal = parseInt(cantidad) * parseInt(producto.historial_precio.precio_venta);

	plan.total = totalPlan;
	plan.cantidad = cantidad;

	var productoCarrito = carrito.filter((obj)=>obj.id==producto.id);
	let index = carrito.findIndex(el=> el.id ==producto.id);
	
	
	if(index=='-1'){
		carrito.push(plan);	
	}else{
		carrito[index] = plan;
	}

	sessionStorage.setItem('carrito',JSON.stringify(carrito));

	llenarTablaCarrito();
}

function llenarTablaCarrito(){
    if(carrito.length==0){
		$('.btnFinalizar').attr('disabled',true);
	}else{
		$('.btnFinalizar').attr('disabled',false);
	}

	if ($.fn.DataTable.isDataTable('.tableDetalles')) {
      
    }
	  


	var htmlTable = `
		
	`;
	$.each(carrito, function(index, el){
		htmlTable+= `
		<div class="cart-item style-1">
		<div class="dz-media">
				<img src="/storage/${this.icono}" alt="/">
		</div>
		<div class="dz-content">
			<div class="dz-head">
				<h6 class="title mb-0">${this.nombre}</h6>
				<a href="javascript:void(0);"><i class="fa-solid fa-xmark text-danger"></i></a>
			</div>
			<div class="dz-body">
				<div class="btn-quantity style-1">
					<div class="input-group bootstrap-touchspin">
					<span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
					<input id="demo_vertical2" type="text" value="1" name="cantidad" class="form-control" style="display: block;">
					<span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span>
					<span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" data-id="${this.id}" type="button"><i class="ti-plus"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="ti-minus"></i></button></span></div>
				</div>
				<h5 class="price text-primary mb-0">$${numberFormat(this.historial_precio.precio_venta * parseInt(this.cantidad))}</h5>
			</div>
		</div>
	</div>


		
		`;
	});


	$('.listaCarrito').html(htmlTable);
	$('.total-factura').html('$'+formatNumber(setTotalCarrito()));
	
	 // Destruir DataTables existente
	
}


function eliminar_plan_carrito(index){
	carrito.splice(index, 1);
	setCarrito();
	llenarTablaCarrito();
}




$(document).on('click','.bootstrap-touchspin-up', async function(e){///FUNCION PARA SUAMAR MAS CANTIDAD EN DETALLE PRODUCTO
	var producto_id = $(this).attr("data-id");
	var cantidad = $("input[name=cantidad]").val();
	var cantidadNueva = parseInt(cantidad) + 1;
	$(this).closest(".btn-quantity").find("input[name=cantidad]").val(cantidadNueva);

	producto = await getProductoById(producto_id);
	console.log(producto);
	if(producto){
		var totalProducto = parseInt(cantidadNueva) * parseInt(producto.historial_precio.precio_venta);

	}

	

	//$("span.text-primary.m-t5.precio").html("$"+numberFormat(totalProducto));
});

/* 
	$(document).on('click','.listaCarrito .bootstrap-touchspin-up', async function(e){///FUNCION PARA SUAMAR MAS CANTIDAD EN DETALLE PRODUCTO
		var producto_id = $(this).attr("data-id");
		var cantidad =  $(this).closest(".btn-quantity").find("input[name=cantidad]").val();
		//var cantidadNueva = parseInt(cantidad) + 1;

		//producto = await getProductoById(producto_id);

		$(this).closest(".btn-quantity").find(".product-detail input[name=cantidad]").val(cantidadNueva);

		//var totalProducto = parseInt(cantidadNueva) * parseInt(producto.historial_precio.precio_venta);

		//$("span.text-primary.m-t5.precio").html("$"+numberFormat(totalProducto));
	});
 */

$(document).on('click','.product-detail .bootstrap-touchspin-up', function(e){///FUNCION PARA SUAMAR MAS CANTIDAD EN DETALLE PRODUCTO
	var cantidad = $(".product-detail input[name=cantidad]").val();
	var cantidadNueva = parseInt(cantidad) + 1;
	$(".product-detail input[name=cantidad]").val(cantidadNueva);

	var totalProducto = parseInt(cantidadNueva) * parseInt(producto.historial_precio.precio_venta);
	

	$("span.text-primary.m-t5.precio").html("$"+numberFormat(totalProducto));
});

$(document).on('click','.product-detail .bootstrap-touchspin-down',function(e){
	var cantidad = $(".product-detail input[name=cantidad]").val();
	if(parseInt(cantidad)>1){
		var cantidadNueva = parseInt(cantidad) - 1;
		$(".product-detail input[name=cantidad]").val(cantidadNueva);
		var totalProducto = parseInt(cantidadNueva) * parseInt(producto.historial_precio.precio_venta);
		$("span.text-primary.m-t5.precio").html("$"+numberFormat(totalProducto));
	}
});


/* 
$(document).on('click','.ti-plus',function(e){
	
	$(`.input_cantidad_${index}`).hide();
	var cantidadNueva = $(`.input_cantidad_${index}`).val();
	var id_plan = $(this).attr('plan_id');

	var params = {
		index:index,
		cantidad:cantidadNueva,
		id_plan:id_plan
	}

	modificarProductoCarrito(params);



}); */


$(document).on('click','.fa-paint-brush',function(e){
	var index = $(this).attr('element');
	$(this).removeClass('fa-paint-brush');
	$(this).addClass('fa-check-square');
	$(`.input_cantidad_${index}`).show();
});

$(document).on('click','.fa-check-square',function(e){
	var index = $(this).attr('element');
	$(this).addClass('fa-paint-brush');
	$(this).removeClass('fa-check-square');
	$(`.input_cantidad_${index}`).hide();
	var cantidadNueva = $(`.input_cantidad_${index}`).val();
	var id_plan = $(this).attr('plan_id');

	var params = {
		index:index,
		cantidad:cantidadNueva,
		id_plan:id_plan
	}

	modificarProductoCarrito(params);
});




function setCarrito(){
	sessionStorage.setItem('carrito',JSON.stringify(carrito));
}





function setTotalCarrito(){
	var total = 0;
	for(var el of carrito){
		total = parseInt(total) + parseInt(el.total);
	}

	return total;
}


function show_error(ms){
	Swal.fire({
	  icon: 'warning',
	  title:'Advertencia',
	  text: ms,
	  showDenyButton: false,
	  showCancelButton: false,
	  confirmButtonText: 'Ok',
	}).then((result) => {
	  
	});
}






function formatNumber(num){
	
	let options = {
	  style: "decimal",
	  minimumFractionDigits: 0,
	  maximumFractionDigits: 0,
	  useGrouping: true,
	  currency: "COP"
	};
	return num.toLocaleString("en-US", options);
}

function eliminar_carrito(){
	sessionStorage.removeItem('carrito');
}



/* mostrar carrito */

$(document).on("click",".btnCarritoFixedBottom",function(e){
	$(".shop-filter.style-1").addClass("openCarrito");
	//alert();
});


$(document).on("click",".panel-close-btn",function(e){
	$(".shop-filter.style-1").removeClass("openCarrito");
});


