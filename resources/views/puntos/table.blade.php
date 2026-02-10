<div class="table-responsive">
    <table class="table" id="puntos-table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Puntos Totales</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($puntos as $p)
                <tr>
                    <td>{{ $p->user->primer_nombre }} {{ $p->user->primer_apellido }}</td>
                    <td>{{ $p->total_puntos }}</td>
                    <td>
                        @php
                            $total = $p->total_puntos * 500;
                        @endphp
                       ${{ number_format($total) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
