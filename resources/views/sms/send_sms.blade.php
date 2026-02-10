@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <h1>Enviar SMS a Usuarios</h1>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

    <div class="card shadow-sm rounded">
        {!! Form::open(['route' => 'sms.send']) !!}
        <div class="card-body">

            {{-- Selección de plantilla --}}
            <div class="form-group">
                <label for="template_id"><strong>Seleccionar plantilla:</strong></label>
                <select name="template_id" id="templateSelect" class="form-control">
                    <option value="">-- Nuevo mensaje --</option>
                    @foreach($templates as $id => $name)
                         <option value="{{ $id }}" data-content="{{ \App\Models\SmsTemplate::find($id)->content }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Textarea de mensaje --}}
            <div class="form-group">
                <label for="message"><strong>Mensaje:</strong></label>
                 <div class="mb-2">
                    <small class="text-muted">Puedes usar etiquetas como:</small><br>
                    <span class="badge badge-secondary">[nombres]</span>
                    <span class="badge badge-secondary">[apellidos]</span>
                    <span class="badge badge-secondary">[telefono]</span>
                    <span class="badge badge-secondary">[email]</span>
                    {{-- Agrega más si lo deseas --}}
                </div>
                <textarea name="message" id="messageTextarea" class="form-control" rows="3" placeholder="Escribe un mensaje si no usas plantilla..."></textarea>
            </div>

            <div class="form-group d-flex gap-2">
                <button type="button" class="btn btn-outline-primary" id="toggleScheduleBtn">
                    Programar envío
                </button>
                <button  style="margin-left:10px" type="submit" class="btn btn-success">Enviar</button>
            </div>

            <div class="form-group" id="scheduleGroup" style="display: none;">
                <label for="send_at"><strong>Fecha y hora del envío:</strong></label>
                <input type="datetime-local" name="send_at" class="form-control" />
            </div>

            {{-- Tabla de usuarios --}}
            <div class="mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" name="user_id[]" value="{{ $user->id }}"></td>
                                <td>{{ $user->primer_nombre }}</td>
                                <td>{{ $user->primer_apellido }}</td>
                                <td>{{ $user->celular }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->estado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>



@endsection
@push('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const templateSelect = document.getElementById('templateSelect');
        const messageTextarea = document.getElementById('messageTextarea');
        const toggleScheduleBtn = document.getElementById('toggleScheduleBtn');
        const scheduleGroup = document.getElementById('scheduleGroup');

        // Cambiar contenido del textarea al seleccionar plantilla
        templateSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const content = selectedOption.dataset.content || '';
            messageTextarea.value = content;
            messageTextarea.disabled = !!content;
        });

        // Mostrar/ocultar programación de envío
        toggleScheduleBtn.addEventListener('click', function () {
            const isVisible = scheduleGroup.style.display === 'block';
            scheduleGroup.style.display = isVisible ? 'none' : 'block';
            toggleScheduleBtn.textContent = isVisible ? 'Programar envío' : 'Cancelar programación';
        });

        // CheckAll para usuarios
        document.getElementById('checkAll').addEventListener('click', function (e) {
            const checkboxes = document.querySelectorAll('input[name="user_id[]"]');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });
    });
</script>
@endpush