<div class="table-responsiv">
    <table class="table  datatableSimple" id="manillaEntradas-table">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Fecha</th>
        </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td> {{ isset($venta->cliente)?$venta->cliente->nombres:'Cliente eliminado' }} </td>
                    <td> {{ isset($venta->cliente)?$venta->cliente->tipo:'Cliente eliminado' }} </td>
                    <td> ${{ number_format($venta->valor) }} </td>
                    <td> {{ $venta->created_at }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
