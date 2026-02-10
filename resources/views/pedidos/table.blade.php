<div class="table-responsive">
    <table class="table" id="manillaEntradas-table">
        <thead>
        <tr>
            <th>Precio Full</th>
            <th>Precio Reducido</th>
            <th>Hora Corte</th>
            <th>Cantidad disponible</th>
            <th>Agregar</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($manillaEntradas as $manillaEntrada)
            <tr>
                <td>{{ $manillaEntrada->precio_full }}</td>
                <td>{{ $manillaEntrada->precio_reducido }}</td>
                <td>{{ $manillaEntrada->hora_corte }}</td>
                <td> {{ $manillaEntrada["stock_manilla"]->cantidad_actual }} </td>
                <td>
                    <a href="javascript:void(0);"  data-manilla-id="{{$manillaEntrada->id}}" class='btn btn-primary btnAddManillas'>
                        <i class="far fa-edit"></i> Agregar
                    </a>
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['manillaEntradas.destroy', $manillaEntrada->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <<!-- a href="{{ route('manillaEntradas.show', [$manillaEntrada->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a> -->
                        <a href="{{ route('manillaEntradas.edit', [$manillaEntrada->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        <!-- {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} -->
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
