<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Usuario:') !!}
    {!! Form::select('user_id', $clientes, null, [
        'class' => 'form-control select2-usuario',
        'id' => 'user_id',
        'style' => 'width: 100%;'
    ]) !!}
</div>

<!-- Membresia Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('membresia_id', 'Membresia Id:') !!}
    {!! Form::select('membresia_id', $membresias, null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Inicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
    {!! Form::date('fecha_inicio', isset($userMembresia) ? $userMembresia->fecha_inicio : null, ['class' => 'form-control', 'id' => 'fecha_inicio']) !!}
</div>

<!-- Fecha Vencimiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vencimiento', 'Fecha Vencimiento:') !!}
    {!! Form::date('fecha_vencimiento', isset($userMembresia) ? $userMembresia->fecha_vencimiento : null, ['class' => 'form-control' . ($errors->has('fecha_vencimiento') ? ' is-invalid' : ''), 'id' => 'fecha_vencimiento']) !!}
    @if($errors->has('fecha_vencimiento'))
        <div class="alert alert-warning mt-2">
            <i class="fas fa-exclamation-triangle mr-1"></i>
            {{ $errors->first('fecha_vencimiento') }}
        </div>
    @endif
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::select('estado', ['activa' => 'Activa', 'expirada' => 'Expirada', 'pendiente' => 'Pendiente', 'suspendida' => 'Suspendida'], null, ['class' => 'form-control', 'id' => 'estado']) !!}
    <small class="form-text text-muted">
        <i class="fas fa-info-circle"></i>
        Para activar una membresía, la Fecha de Vencimiento debe ser una fecha futura.
    </small>
</div>

<!-- Select2 CSS (se coloca aquí para garantizar que cargue, sin depender del layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css">

@push('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-usuario').select2({
            placeholder: 'Buscar usuario por nombre...',
            allowClear: true,
            language: {
                noResults: function () {
                    return "No se encontraron usuarios";
                },
                searching: function () {
                    return "Buscando...";
                }
            }
        });
    });
</script>
@endpush