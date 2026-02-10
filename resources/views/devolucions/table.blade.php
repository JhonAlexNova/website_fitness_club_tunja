<div class="table-responsiv">
    <table class="table datatableSimple" id="devolucions-table">
        <thead>
        <tr>
            <th>N</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Producto Cambiado por</th>
            <th>Cant unidades cambiadas</th>
            <th>Ganancia</th>
        </tr>
        </thead>
        <tbody>
        @foreach($devolucions as $index => $devolucion)
            @if(isset($devolucion->detalle_devolucion->producto))
                <tr>
                    <td> {{$index + 1}} </td>
                    <td>{{ $devolucion->tipo }}</td>
                    <td>{{ $devolucion->created_at }}</td>
                    <td>{{ $devolucion->detalle_devolucion->producto->nombre }} </td>
                    <td>{{ 
                            isset($devolucion->detalle_devolucion->producto_cambio)?$devolucion->detalle_devolucion->producto_cambio->nombre:'NO APLICA'    
                        }} 
                </td>
                    <td> {{ $devolucion->detalle_devolucion->cantidad_unidades_devolucion }} </td>
                    <td>${{ number_format($devolucion->detalle_devolucion->total_ganancia) }}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
