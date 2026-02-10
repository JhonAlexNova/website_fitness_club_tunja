<div class="table-responsive-">
    <table class="table datatableSimple" id="userMembresias-table">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Membresia</th>
            <th>Fecha Inicio</th>
            <th>Fecha Vencimiento</th>
            <th>Estado</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($userMembresias as $userMembresia)
            <tr>
            <td>
                {{ $userMembresia->user->primer_nombre}} {{ $userMembresia->user->segundo_nombre}}
                {{ $userMembresia->user->primer_apellido}} {{ $userMembresia->user->segundo_apellido}}

            </td>
            <td>{{ $userMembresia->membresia->nombre }}</td>
            <td>{{ $userMembresia->fecha_inicio }}</td>
            <td>{{ $userMembresia->fecha_vencimiento }}</td>
            <td>{{ $userMembresia->estado }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['userMembresias.destroy', $userMembresia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('userMembresias.show', [$userMembresia->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('userMembresias.edit', [$userMembresia->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
