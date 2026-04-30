@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Músculos</h2>

    <a href="{{ route('musculos.create') }}" class="btn btn-primary mb-3">
        Nuevo músculo
    </a>

    @php
        $grupos = [
            'cuerpo_superior' => 'Cuerpo Superior',
            'cuerpo_inferior' => 'Cuerpo Inferior',
        ];
    @endphp

    @foreach($grupos as $key => $label)
        @php $lista = $musculos->where('categoria', $key); @endphp
        @if($lista->count())
            <h4 class="mt-4 mb-2">
                <span class="badge badge-secondary">{{ $label }}</span>
            </h4>
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
                    @foreach($lista as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->nombre }}</td>
                        <td>
                            @if($m->imagen)
                                <img src="{{ asset('storage/'.$m->imagen) }}" width="80" class="img-thumbnail">
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
        @endif
    @endforeach

</div>
@endsection