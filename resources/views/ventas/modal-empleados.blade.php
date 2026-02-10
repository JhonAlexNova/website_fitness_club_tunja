
<!-- Modal -->
<div class="modal fade" id="modalSelectorEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seleccione el empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            @foreach($empleados as $index => $empleado)
              <div class="col-md-3">
                  <label for="person-{{$index}}">
                    <div class="persona">
                          <div class="foto">
                              <img src="{{ url('storage',$empleado->foto_perfil) }}">
                          </div>
                          <div class="info">
                              <p>
                                {{ $empleado->primer_nombre }} {{ $empleado->segundo_nombre }} {{ $empleado->primer_apellido }}
                                <span class="selector">
                                  <input type="radio" name='empleado' value="{{$empleado->id}}" id="persona-{{$index}}"> 
                                </span>
                              </p>
                          </div>
                      </div>
                  </label>
                </div>
              @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btnFinalizar">Finalizar</button>
      </div>
    </div>
  </div>
</div>