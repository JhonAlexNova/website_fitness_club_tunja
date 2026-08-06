<div class="">
    <table class="table datatableSimple" id="baseEmpleados-table">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Fecha registro</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservas as $reserva)
            <tr>
                <td>
                    {{ $reserva->cliente->primer_nombre }} {{ $reserva->cliente->primer_apellido }}

                    @if($reserva->productos_adicionales->isNotEmpty())
                        <div class="mt-1">
                            <span class="badge badge-info">
                                <i class="fas fa-shopping-cart"></i> Con productos
                            </span>
                            <ul class="mb-0 pl-3" style="font-size: 12px; color: #6c757d;">
                                @foreach($reserva->productos_adicionales as $producto)
                                    <li>{{ $producto['nombre'] }} x{{ $producto['cantidad'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="mt-1">
                            <span class="badge badge-secondary">
                                Sin productos adicionales
                            </span>
                        </div>
                    @endif
                </td>
                <td> {{ $reserva->created_at }} </td>
                <td> {{ $reserva->estado }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>