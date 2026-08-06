<div class="">
    <table class="table datatableSimple" id="tableReservasClases">
        <thead>
        <tr>
            <th>Clase</th>
            <th>Fecha clase</th>
            <th>Cantidad permitidos</th>
            <th>Cantidad inscritos</th>
            <th>Inscritos</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservas_clase as $reserva)
            <tr>
                <td>
                    @if ($reserva->horario_clase && $reserva->horario_clase->clase)
                        {{ $reserva->horario_clase->clase->nombre }}
                    @elseif ($reserva->horario_clase)
                        Clase eliminada (ID: {{ $reserva->horario_clase->clase_id ?? 'N/D' }})
                    @else
                        Horario eliminado
                    @endif
                </td>
                <td>{{ $reserva->fecha_reserva }}</td>
                <td>{{ $reserva->horario_clase?->cupo_maximo ?? 'Horario eliminado' }}</td>
                <td>{{ $reserva->inscritos }}</td>
                <td>
                    <a href="#" class="btn btn-primary btn-inscritos" data-fecha_reserva="{{ $reserva->fecha_reserva }}">
                        Inscritos
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>