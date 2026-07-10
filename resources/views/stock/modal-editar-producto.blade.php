<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarProductoLabel">Editar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarProducto">
            <input type="hidden" id="editar-producto-id" name="producto_id">

            <div class="form-group">
                <label for="editar-nombre">Nombre:</label>
                <input type="text" class="form-control" id="editar-nombre" name="nombre" maxlength="255" required>
            </div>

            <div class="form-group">
                <label for="editar-descripcion">Descripcion (HTML):</label>
                <textarea class="form-control" id="editar-descripcion" name="descripcion" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Vista previa:</label>
                <div id="preview-descripcion" class="border rounded p-2" style="min-height: 60px; background:#f8f9fa;"></div>
            </div>

            <div class="form-group">
                <label for="editar-categoria">Categoria:</label>
                <select class="form-control" id="editar-categoria" name="categoria_id" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="editar-precio-venta">Precio de venta:</label>
                <input type="text" class="form-control precio" id="editar-precio-venta" name="precio_venta" required>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Cerrar
        </button>
        <button type="button" class="btn btn-primary" id="btn-guardar-producto">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar cambios
        </button>
      </div>
    </div>
  </div>
</div>