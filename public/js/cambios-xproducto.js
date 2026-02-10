var productoIngreso = {};
var productoSalida = {};
var carrito = [];

if(sessionStorage.getItem('carrito_cambios_productos')===null){
	carrito = [];
	llenarTablaCarrito();
}else{
	carrito = JSON.parse(sessionStorage.getItem('carrito_cambios_productos'));

	llenarTablaCarrito();
}

var totalCarrito = 0;

$(document).on('submit','#formProductoIngreso',async function(e){
	e.preventDefault();
	var sku = $('#formProductoIngreso .sku-search').val();
	
    productoIngreso = await getProducto(sku);
    $("#detalleProductoIngreso input[name=precio_venta]").val(productoIngreso.historial_precio.precio_venta);
    $("#detalleProductoIngreso input[name=nombre]").val(productoIngreso.nombre);
    $("#detalleProductoIngreso input[name=cantidad_disponible]").val(productoIngreso.historial_producto.cantidad_actual);
    $("#detalleProductoIngreso .foto img").attr("src",`/storage/${productoIngreso.icono}`)
});


$(document).on('submit','#formProductoSalida',async function(e){
	e.preventDefault();
	var sku = $('#formProductoSalida .sku-search').val();
	
    productoSalida = await getProducto(sku);
    $("#detalleProductoSalida input[name=precio_venta]").val(productoSalida.historial_precio.precio_venta);
    $("#detalleProductoSalida input[name=nombre]").val(productoSalida.nombre);
    $("#detalleProductoSalida input[name=cantidad_disponible]").val(productoSalida.historial_producto.cantidad_actual);
    $("#detalleProductoSalida .foto img").attr("src",`/storage/${productoSalida.icono}`)
});



function getProducto(reference){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:`/productos/${reference}?attribute=sku`,
            method:'get',
            success:function(response){
               resolve(response);
            }
        });
    })
}

/* ingresar producto */
$(document).on('click','.btnAgregarProductoIngreso',function(response){
	
	var cantidad = $('#detalleProductoIngreso input[name=cantidad]').val();



	if(cantidad==''){
		toastr.warning('Digite una cantidad validad','Advertencia',{progressBar:true});
		return false;
	}

	var total = parseInt(cantidad) * parseInt(productoIngreso.historial_precio.precio_venta);

	productoIngreso.total = total;
	productoIngreso.cantidad = cantidad;
    productoIngreso.tipo="INGRESO";


	var CarritoSearch = carrito.filter((obj)=>obj.id==productoIngreso.id);
	let index = carrito.findIndex(el=> el.id ==productoIngreso.id);


    if(index=='-1'){
		carrito.push(productoIngreso);	
        toastr.success('Producto agregado correctamente','Advertencia',{progressBar:true});
	}else{
		carrito[index] = productoIngreso;
        toastr.success('Producto actualizado','Advertencia',{progressBar:true});
	}

    sessionStorage.setItem('carrito_cambios_productos',JSON.stringify(carrito));


  //  add_carrito_session(productoIngreso, cantidad, "INGRESO");

  llenarTablaCarrito()
});





//agregar producto a carrito
$(document).on('click','.btnAgregarProductoSalida',function(response){
	
	var cantidad = $('#detalleProductoSalida .cantidad_compra').val();
	var cantidad_disponible = parseInt($('#detalleProductoSalida input[name=cantidad_disponible]').val());


	if(cantidad==''){
		toastr.warning('Digite una cantidad validad','Advertencia',{progressBar:true});
		return false;
	}

	if(cantidad>cantidad_disponible){
		toastr.warning('La cantidad no puede superar al inventario disponible','Advertencia',{progressBar:true});
		return false;
	}


	
	var total = parseInt(cantidad) * parseInt(productoSalida.historial_precio.precio_venta);

	productoSalida.total = total;
	productoSalida.cantidad = cantidad;
    productoSalida.tipo = "SALIDA";

	var CarritoSearch = carrito.filter((obj)=>obj.id==productoSalida.id);
	let index = carrito.findIndex(el=> el.id ==productoSalida.id);
	
	
	if(index=='-1'){
		carrito.push(productoSalida);	
        toastr.success('producto agregado correctamente','Advertencia',{progressBar:true});
	}else{
		carrito[index] = productoSalida;
        toastr.success('Producto actualizado','Advertencia',{progressBar:true});
	}

	sessionStorage.setItem('carrito_cambios_productos',JSON.stringify(carrito));

	llenarTablaCarrito();

	/* $('#detalleProductoVenta').html('');
	$(".sku-search").val('');
	$(".sku-search").focus(); */

	/*  */

	// Obtén la instancia actual de Select2
   /*  var select2Instance = $('select[name=producto_id]').data('select2');

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



function llenarTablaCarrito(){
    if(carrito.length==0){
		$('.btnFinalizar').attr('disabled',true);
	}else{
		$('.btnFinalizar').attr('disabled',false);
	}

	if ($.fn.DataTable.isDataTable('.tableDetalles')) {
      
    }
	  $('.tableDetalles').DataTable().destroy();


	var htmlTable = '';
	$.each(carrito, function(index, el){
		htmlTable+= `
			<tr>
                <td> ${this.tipo} </td>
                <td>  ${this.sku} </td>
				<td>  ${this.nombre} </td>
				<td>  $${numberFormat(this.historial_precio.precio_venta)} </td>
				<td>  
					${this.cantidad} 
					<input  type="number" value="${this.cantidad}" class="input_cantidad_${index}" style="display:none"/>
				</td>
				<td>  $${formatNumber(this.total)} </td>
				<td>  <i class="fa fa-trash" onclick="eliminar_plan_carrito(${index})" aria-hidden="true"></i>  </td>
			</tr>
		`;
	});


	$('.tableDetalles tbody').html(htmlTable);
	$('.total').html('$'+formatNumber(setTotalCarrito()));
	
	 // Destruir DataTables existente
	


	$('.tableDetalles').DataTable({
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


function setTotalCarrito(){
	var total = 0;
	for(var el of carrito){
		total = parseInt(total) + parseInt(el.total);
	}

	return total;
}


function get_total_ingresos(){
	var total = 0;
	for(var elemento of carrito){
		if(elemento.tipo=="INGRESO"){
			total += parseInt(elemento.total);	
		}
	}
	return parseInt(total);
}

function get_total_salidas(){
	var total = 0;
	for(var elemento of carrito){
		if(elemento.tipo=="SALIDA"){
			total += parseInt(elemento.total);	
		}
	}
	return parseInt(total);
}

$(document).on('click', '.btnFinalizar', async function(e) {
	var csrf_token = $('meta[name="csrf-token"]').attr('content');


	var totalEntradas = get_total_ingresos();
	var totalSalidas = get_total_salidas();

	if(totalEntradas!=totalSalidas){
		toastr.warning('Venta realizada correctamente','Mensaje');
		return false;
	}



	var data = {
		carrito: carrito,
		_token: csrf_token,
		total:totalEntradas
	};

	// Envía la solicitud AJAX
	$.ajax({
		url: '/cambios-x-producto', // Cambia esta URL a la ruta correcta en tu aplicación
		type: 'POST',
		data: data,
		success: function(response) {
			sessionStorage.removeItem('carrito_cambios_productos');
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
