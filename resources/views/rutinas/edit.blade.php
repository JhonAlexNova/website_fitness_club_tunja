@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Rutina usuario</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6>Rutina</h6>
                        <hr>
            
                        {!! Form::model($rutina, ['route' => ['rutinas.update', $rutina->id], 'method' => 'patch']) !!}
                            @include('rutinas.fields')
                        
                        <div class="card-footer">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('rutinas.index') }}" class="btn btn-default">Cancel</a>
                        </div>
            
                        {!! Form::close() !!}
                    </div>        
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                              <h5>Rutina usuario</h5>
                              <a href="#staticBackdrop" data-toggle="modal" class="btn btn-sm btn-outline-primary float-right">Seleccionar ejercicios</a> <br>
                              <hr>
                          </div>
                          <div class="col-md-12">
                            <table class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                    <th>Video</th>
                                    <th>Ejercicio</th>
                                    <th>Volumen</th>
                                    <th>Intensidad</th>
                                    <th>Frecuencia</th>
                                    <th>Opciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($rutina->ejercicios_rutina as $ejercicioRutina)
                                  <tr>
                                    <td width="200px">
                                       @if($ejercicioRutina->ejercicio->video_url)
                                          <button class="btn btn-sm btn-info btn-view-video" 
                                                  data-video-url="{{url('storage', $ejercicioRutina->ejercicio->video_url)}}">
                                              <i class="fas fa-play"></i> Ver Video
                                          </button>
                                          @else
                                          <span class="text-muted">Sin video</span>
                                       @endif
                                    </td>
                                    <td>{{ $ejercicioRutina->ejercicio->nombre_ejercicio }}</td>
                                    <td>{{ $ejercicioRutina->volumen }}</td>
                                    <td>{{ $ejercicioRutina->intensidad }}</td>
                                    <td>{{ $ejercicioRutina->frecuencia }}</td>
                                    <td>
                                      <form action="{{ route('admon.ejerciciosRutina.destroy', $ejercicioRutina->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-primary btn-sm btnEdit" data-id="{{$ejercicioRutina->id}}">Editar</button>
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                      </form>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- seleccionar ejercicios -->
     <!-- Button trigger modal -->
   
<style>
  .card {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
  }

  .form-group label {
    font-weight: 500;
  }
</style>
<!-- Modal -->
<form action="{{ route('admon.ejerciciosRutina.store', ['id_rutina' => $rutina->id]) }}" method="POST" id="form-ejercicios">
  @csrf
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar Ejercicios a la Rutina</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>

          <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <div class="form-group">
                <input type="text" id="search-ejercicio" class="form-control" placeholder="Buscar ejercicio...">
            </div>
            


              @foreach($ejercicios as $ejercicio)
              <div class="card ejercicio-item" 
                    data-nombre="{{ strtolower($ejercicio->nombre_ejercicio) }}"
                    data-musculo="{{ strtolower($ejercicio->musculo_objetivo) }}"
                    data-equipo="{{ strtolower($ejercicio->equipo) }}"
                    data-dificultad="{{ strtolower($ejercicio->nivel_dificultad) }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!--  -->
                                <div class="row">
                                    <div class="col-md-4">
                                    <div class="">
                                        <input type="checkbox" class="ejercicio-check mb-2" data-id="{{ $ejercicio->id }}" name="ejercicios[]" value="{{$ejercicio->id }}">
                                        <div class="video mb-2" style="width: 200px;">
                                            <video src="{{url('storage',$ejercicio->video_url)}}" controls width="100%"></video>
                                        </div>
                                        <strong>{{ $ejercicio->nombre_ejercicio }}</strong><br>
                                        <small>
                                        <b>Músculo:</b> {{ $ejercicio->musculo_objetivo ?? 'N/A' }}<br>
                                        <b>Equipo:</b> {{ $ejercicio->equipo ?? 'N/A' }}<br>
                                        <b>Dificultad:</b> {{ $ejercicio->nivel_dificultad }}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="flex-fill">
                                        <div class="form-group">
                                        <label>Volumen</label>
                                        <input type="text" name="volumen|{{$ejercicio->id}}[]" class="form-control input-ejercicio">
                                        </div>
                                        <div class="form-group">
                                        <label>Intensidad</label>
                                        <input type="text" name="intensidad|{{$ejercicio->id}}[]" class="form-control input-ejercicio">
                                        </div>
                                        <div class="form-group">
                                        <label>Frecuencia</label>
                                        <input type="text" name="frecuencia|{{$ejercicio->id}}[]" class="form-control input-ejercicio">
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
              </div>
              @endforeach
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar Rutina</button>
          </div>
        </div>
      </div>
    </div>



</form>


{{-- modal edit --}}

<form id="form-edit-ejercicio"  action="{{ route('ejercicios.update', ':id') }}" method="POST">
  @csrf
<div class="modal fade" id="modalEditEjercicio" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Editar Ejercicio en Rutina</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <!-- Aquí se insertará el contenido vía AJAX -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
  
</form>
  

{{--  --}}


<!--  -->
@include('ejercicios.partials.modal-video')
@endsection



@push("page_scripts")
@include('ejercicios.partials.scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.ejercicio-check').forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
        const id = this.dataset.id;
        const inputs = document.querySelectorAll(`[name^="[${id}]"]:not([type=checkbox])`);
        inputs.forEach(input => input.disabled = !this.checked);
      });
    });
  });

  /* buscador */
  document.addEventListener("DOMContentLoaded", function () {
    // Habilitar/deshabilitar inputs según checkbox
    document.querySelectorAll('.ejercicio-check').forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
        const id = this.dataset.id;
        const inputs = document.querySelectorAll(`[name^="[${id}]"]:not([type=checkbox])`);
        inputs.forEach(input => input.disabled = !this.checked);
      });
    });

    // Búsqueda de ejercicios
    const searchInput = document.getElementById('search-ejercicio');
    searchInput.addEventListener('input', function () {
      const query = this.value.toLowerCase();
      document.querySelectorAll('.ejercicio-item').forEach(function (item) {
        const nombre = item.dataset.nombre || '';
        const musculo = item.dataset.musculo || '';
        const equipo = item.dataset.equipo || '';
        const dificultad = item.dataset.dificultad || '';

        if (
          nombre.includes(query) || 
          musculo.includes(query) || 
          equipo.includes(query) || 
          dificultad.includes(query)
        ) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });


  /* EDITAR EJERCICIO RUTINA */
$('.btnEdit').click(function () {
    var id = $(this).data('id');

    $.ajax({
        url: "{{ route('admon.ejerciciosRutina.edit', ':id') }}".replace(':id', id),
        type: 'GET',
        success: function (response) {
            $('#modalEditEjercicio .modal-body').html(response.html);

            // ⚠️ Reemplaza ":id" del form con el ID real
            $('#form-edit-ejercicio').attr(
                'action',
                "{{ route('admon.ejerciciosRutina.update', ':id') }}".replace(':id', id)
            );

            $('#modalEditEjercicio').modal('show');
        },
        error: function () {
            alert('Error al cargar los datos.');
        }
    });
});

  
</script>
@endpush