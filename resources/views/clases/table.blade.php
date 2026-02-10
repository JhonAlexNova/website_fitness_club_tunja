<div class="table-responsive">
    <table class="table datatableSimple" id="clases-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clases as $clase)
            <tr>
                <td>{{ $clase->nombre }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['admon.clases.destroy', $clase->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admon.clases.edit', [$clase->id]) }}"
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
