<!-- Modal -->
<div class="modal fade" id="facturaModal" tabindex="-1" aria-labelledby="facturaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="facturaModalLabel">Detalles de la Transacción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr><th>Referencia</th><td id="modalReferencia"></td></tr>
            <tr><th>Tipo</th><td id="modalTipo"></td></tr>
            <tr><th>Tipo Pago</th><td id="modalTipoPago"></td></tr>
            <tr><th>Valor</th><td id="modalValor"></td></tr>
            <tr><th>Estado</th><td id="modalEstado"></td></tr>
            <tr><th>Cliente</th><td id="modalCliente"></td></tr>
            <tr><th>Fecha</th><td id="modalFecha"></td></tr>
            <tr>
              <th>Comprobante</th>
              <td id="modalComprobante">
                <img src="" id="comprobanteImg" class="img-fluid" alt="Comprobante" />
              </td>
            </tr>
            <tr>
              <th>Comentario</th>
              <td>
                <textarea id="modalComentario" class="form-control" placeholder="Opcional..."></textarea>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button id="btnAprobar" class="btn btn-success">Aprobar</button>
        <button id="btnRechazar" class="btn btn-danger">Rechazar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
