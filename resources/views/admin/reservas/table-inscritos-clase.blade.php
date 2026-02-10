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
                <td>{{ $reserva->cliente->primer_nombre }} {{ $reserva->cliente->primer_apellido }}</td>
                <td> {{ $reserva->created_at }} </td>
                <td> {{ $reserva->estado }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
