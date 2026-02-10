<div class="modal fade" id="modalAddStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {!! Form::model($producto, ['route' => ['productos.update', $producto->id], 'method' => 'patch','files'=>true,'id'=>'formEdit']) !!}
            <div class="card-body">
                <div class="row">
                    @include('stock.fields')
                </div>
            </div>
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Cerrar</button>
        <button type="button" class="btn btn-primary btn-update-stock"><i class="fa fa-floppy-o" aria-hidden="true"></i> Subir stock</button>
      </div>
    </div>
  </div>
</div>