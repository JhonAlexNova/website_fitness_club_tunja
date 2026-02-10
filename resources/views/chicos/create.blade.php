@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Crear Chico</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'chicos.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('chicos.fields')
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class='btn btn-primary'><i class="fa fa-floppy-o" aria-hidden="true"></i> Crear</button>
                <a href="{{ route('chicos.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Volver</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection


@push('page_scripts')
<script>
    var configuracion = @json($configuracion);
    $(document).on('keyup','.cantidad',function(e){
        var empleado = $(this).val();   
        var total = parseInt($(this).val() * parseInt(configuracion.valor_chico));
        $('.total').val(numberFormat(total));
    });
</script>
@endpush
