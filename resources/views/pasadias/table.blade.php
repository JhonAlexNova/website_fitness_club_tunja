<div class="table-responsive-">
    <table class="table datatableSimple" id="pasadias-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Descripcion</th>
            <th>Costo</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pasadias as $pasadia)
            <tr>
                <td>{{ $pasadia->nombre }}</td>
               <td>
                    @if($pasadia->imagen)
                        <img src="{{url('storage',$pasadia->imagen)}}" alt="" style="width: 100px; height: auto;">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </td>
                <td>{{ $pasadia->descripcion }}</td>
                <td>{{ $pasadia->costo }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['pasadias.destroy', $pasadia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('pasadias.edit', [$pasadia->id]) }}"
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