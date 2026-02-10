<div class="table-responsive">
    <table class="table" id="valorCaracteristicas-table">
        <thead>
        <tr>
            <th>Caracteristica</th>
            <th>Valor</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($valorCaracteristicas as $valorCaracteristica)
            <tr>
            <td>{{ $valorCaracteristica->caracteristica->nombre }}</td>
            <td>{{ $valorCaracteristica->valor }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['valorCaracteristicas.destroy', $valorCaracteristica->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('valorCaracteristicas.show', [$valorCaracteristica->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('valorCaracteristicas.edit', [$valorCaracteristica->id]) }}"
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
