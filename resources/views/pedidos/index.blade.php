@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pedidos</h1>
                </div>
                <div class="col-sm-6">
                   <!--  <a class="btn btn-primary float-right"
                       href="{{ route('manillaEntradas.create') }}">
                        Add New
                    </a> -->
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('manilla_entradas.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

       




@endsection


@push('page_scripts')
<script>
        var manilla_id = null;
        var pedido = {};
        var configGlobal = @json($configGlobal);

        $(document).on("click",".btnComprarTicket",async function(e){
            var pedido_id = $(this).attr("data-id");
            pedido = await getPedido(pedido_id);
           imprimir();
        });

        function getPedido(pedidoId){
            return new Promise((resolve, reject)=>{
                $.ajax({
                    url:`facturas/${pedidoId}?type=json`,
                    method:"get",
                    success:function(e){
                        resolve(e)
                    }
                })

            });
        }

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
                        <td>Cantidad</b></td>
                        <td>Aporte</td>
                    </tr>
                </thead>
                <tbody>
                    ${getTableStock()}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b>Total<b></td>
                        
                        <td>${numberFormat(pedido.total)}</td>
                    </tr>
                </tfoot>
            </table>
            
            <p>10% de propina</p>
            <p>No válido como factura</p>
            `;
            return html;
        }

        function getTableStock(){
            var filas = ``;

            for(var el of pedido.detalles_facturas){
                filas += `
                    <tr >
                        <td style="    border-bottom: 1px #00000080 dotted;"> ${el.producto.nombre} </td>
                        <td style="    border-bottom: 1px #00000080 dotted;">${el.cantidad}</td>
                        <td style="    border-bottom: 1px #00000080 dotted;">${numberFormat(el.total)}</td>
                    </tr>
                `;
            }

            return filas;
        }

        function getHead(){
            var head =  `
                <div style="    text-align: center;
                    line-height: 0;
                    margin: 35px 0 55px 0;">
                    <p>  Corporación </p>
                    <p> <b>Empleado</b> ${pedido.empleado.primer_nombre}  </p>
                    <p> </br> ${pedido.created_at.substr(0,20)}</b> </p>
                </div>
            `;

            return head;
        }



</script>
@endpush
