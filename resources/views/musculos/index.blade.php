@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Músculos</h2>

    <a href="{{ route('musculos.create') }}" class="btn btn-primary mb-3">
        Nuevo músculo
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th width="180">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($musculos as $m)
            <tr>
                <td>{{ $m->id }}</td>
                <td>{{ $m->nombre }}</td>

                <td>
                    @if($m->imagen)
                        <img src="{{ asset('musculos/'.$m->imagen) }}" width="80" class="img-thumbnail">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('musculos.edit', $m->id) }}" class="btn btn-sm btn-warning">
                        Editar
                    </a>
                    
                    {!! Form::open([
                        'route' => ['musculos.destroy', $m->id],
                        'method' => 'delete',
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::submit('Eliminar', [
                            'class' => 'btn btn-sm btn-danger',
                            'onclick' => 'return confirm("¿Eliminar músculo?")'
                        ]) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $musculos->links() }}
</div>
@endsection