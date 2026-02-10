@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Rutina</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')
         @include('flash::message')

        <div class="card">

            {!! Form::open(['route' => 'admon.rutinas.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('rutinas.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('rutinas.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
@push('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const esGeneralCheckbox = document.getElementById('es_general');
        const userIdContainer = document.getElementById('user_id_container');

        function toggleUserField() {
            if (esGeneralCheckbox.checked) {
                userIdContainer.style.display = 'none';
            } else {
                userIdContainer.style.display = 'block';
            }
        }

        // Inicial
        toggleUserField();

        // Al cambiar el checkbox
        esGeneralCheckbox.addEventListener('change', toggleUserField);
    });
</script>
@endpush