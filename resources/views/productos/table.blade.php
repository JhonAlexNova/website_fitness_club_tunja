<div class="table-responsie">
    <table class="table datatableSimple" id="productos-table">
        <thead>
        <tr>
            <th>Icono</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>
                    <img class='avatar-profile-table' src="{{ !is_null($producto->portada)?url('storage',$producto->portada->url):url('img/imagen-placeholder.png') }}" alt="">
                </td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ isset($producto->categoria)?$producto->categoria->nombre:'Categoria eliminada' }}</td>
                <td width="120">
                     
                        {!! Form::open(['route' => ['productos.destroy', $producto->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('productos.edit', [$producto->id]) }}"
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
