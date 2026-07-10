@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{url('css/stock.min.css')}}">
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventario productos</h1>
                </div>
                <div class="col-sm-6">
                   <!--  <a class="btn btn-primary float-right"
                       href="{{ route('productos.create') }}">
                       <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                    </a> -->
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button onclick="imprimir()">Imprimir</button>
                    </div>
                </div>
                @include('stock.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- div abastecer -->
    <div id="modalAgregar"></div>

    <!-- modal editar producto -->
    @include('stock.modal-editar-producto')

@endsection

@push('page_scripts')
<script src='{{url("js/stock.min.js")}}?id={{rand(2000,10000)}}'></script>
<script>
    var productos = @json($productos);
    var configGlobal = @json($configGlobal);
    var estadisticas;
    estadisticas =  getEstadisticas();

        function imprimir() {
            var ventana = window.open('', '_blank');
            ventana.document.open();
            ventana.document.write('<html><head><title>Imprimir</title></head><body>');
            ventana.document.write(getHtml());
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.print();
        }
        
        
        function getHtml(){
            var html = `
            ${getHead()}
                
                <table style='width: 100%;
                    display: table;'>
                    <thead>
                        <tr>
                            <td><b>Producto<b></td>
                            <td><b>Uni. Disponibles</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        ${getTableStock()}
                    </tbody>
                </table>

                
                
                <table style='width: 100%;
                    display: table;'>
                    <thead>
                        <tr>
                            <td><b>Tipo<b></td>
                            <td><b>Valor</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        ${getTableIngresosPorTipo()}
                    </tbody>
                </table>
                
                <b>Venta del dia:$${numberFormat(estadisticas.ventas_dia)}</b></br>
            `;
            return html;
        }


        function getTableIngresosPorTipo(){
            var filas = '';
            filas+=`
            <tr>
                <td> Total gastos</td>
                <td> $${numberFormat(estadisticas.totalGastos) } </td>
            </tr>

            <tr>
                <td> Total ganancia por devoluciones</td>
                <td> $${ numberFormat(estadisticas.ganancia_x_devoluciones) } </td>
            </tr>
           
            `;
            if(configGlobal.tipo_negocio_id==1){
                filas += `
                    <tr>
                        <td> Ingreso de chicos</td>
                        <td>$ ${ numberFormat(estadisticas.venta_chicos) } </td>
                    </tr>
                `; 
            }
            for(var el of estadisticas.pagosXtipo){
                filas += `
                    <tr >
                        <td style="    border-bottom: 1px #00000080 dotted;"> ${el.tipo} </td>
                        <td style="    border-bottom: 1px #00000080 dotted;">$${numberFormat(el.valor)}</td>
                    </tr>
                `;
            }

            return filas;
        }

        function getTableStock(){
            var filas = ``;

            for(var el of productos){
                if(el.historial_producto.cantidad_actual>0){
                    filas += `
                        <tr >
                            <td style="    border-bottom: 1px #00000080 dotted;"> ${el.nombre} </td>
                            <td style="    border-bottom: 1px #00000080 dotted;">$${el.historial_producto.cantidad_actual}</td>
                        </tr>
                    `;
                }
            }

            return filas;
        }

        function getHead(){
            var head =  `
                <div style="    text-align: center;
                    line-height: 0;
                    margin: 20px 0 20px 0;">
                    <p> ${configGlobal.razon_social} <p>
                    <p>Nit ${configGlobal.nit} <p>
                    <p> ${configGlobal.direccion} <p>
                    <p> ${configGlobal.celular} <p>
                </div>
            `;

            return head;
        }

        function getEstadisticas(){
            
                $.ajax({
                    url:'home?type=json',
                    method:'get',
                    success:function(response){
                        estadisticas = response;
                    },error:function(e){
                    }
                })
            
        }

        /* ============ EDITAR / ELIMINAR PRODUCTO ============ */

        $(document).on('click', '.btn-editar-producto', function(){
            var producto_id = $(this).attr('producto_id');
            var nombre = $(this).data('nombre');
            var descripcion = $(this).data('descripcion');
            var categoria_id = $(this).data('categoria_id');
            var precio_venta = $(this).data('precio_venta');

            $('#editar-producto-id').val(producto_id);
            $('#editar-nombre').val(nombre);
            $('#editar-descripcion').val(descripcion);
            $('#editar-categoria').val(categoria_id);
            $('#editar-precio-venta').val(precio_venta);

            $('#modalEditarProducto').modal('show');
        });

        $(document).on('click', '#btn-guardar-producto', function(){
            var producto_id = $('#editar-producto-id').val();

            if(!$('#editar-nombre').val() || !$('#editar-categoria').val() || !$('#editar-precio-venta').val()){
                alert('Por favor completa los campos obligatorios.');
                return;
            }

            var data = {
                nombre: $('#editar-nombre').val(),
                descripcion: $('#editar-descripcion').val(),
                categoria_id: $('#editar-categoria').val(),
                precio_venta: $('#editar-precio-venta').val(),
                _method: 'PUT'
            };

            $.ajax({
                url: 'productos/' + producto_id,
                method: 'POST',
                data: data,
                success: function(response){
                    $('#modalEditarProducto').modal('hide');
                    location.reload();
                },
                error: function(e){
                    console.log(e);
                    alert('Ocurrió un error al actualizar el producto.');
                }
            });
        });

        $(document).on('click', '.btn-eliminar-producto', function(){
            var producto_id = $(this).attr('producto_id');

            if(!confirm('¿Estás seguro de eliminar este producto? Esta acción no se puede deshacer.')){
                return;
            }

            $.ajax({
                url: 'productos/' + producto_id,
                method: 'POST',
                data: { _method: 'DELETE' },
                success: function(response){
                    $('#fila-producto-' + producto_id).remove();
                },
                error: function(e){
                    console.log(e);
                    alert('Ocurrió un error al eliminar el producto.');
                }
            });
        });
</script>
@endpush