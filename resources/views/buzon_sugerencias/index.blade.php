@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buzón de Sugerencias</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-3">

                <form method="GET" class="form-inline mb-3">
                    <select name="tipo" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="">Todos los tipos</option>
                        <option value="problema" {{ request('tipo') == 'problema' ? 'selected' : '' }}>Problema</option>
                        <option value="sugerencia" {{ request('tipo') == 'sugerencia' ? 'selected' : '' }}>Sugerencia</option>
                        <option value="recomendacion" {{ request('tipo') == 'recomendacion' ? 'selected' : '' }}>Recomendación</option>
                        <option value="pregunta" {{ request('tipo') == 'pregunta' ? 'selected' : '' }}>Pregunta / Duda</option>
                    </select>

                    <select name="estado" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="">Todos los estados</option>
                        <option value="nuevo" {{ request('estado') == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                        <option value="leido" {{ request('estado') == 'leido' ? 'selected' : '' }}>Leído</option>
                        <option value="respondido" {{ request('estado') == 'respondido' ? 'selected' : '' }}>Respondido</option>
                    </select>
                </form>

                @include('buzon_sugerencias.table')

                <div class="mt-3">
                    {{ $mensajes->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection