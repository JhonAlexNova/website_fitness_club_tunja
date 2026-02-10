<style>
    .terminos {
    overflow-y: auto;
    max-height: 34vh;
}
</style>
<div class="modal" id="modalAcercaDe">
    <div class="modal-dialog modal-lg" style="width: 83.3333%;"><!-- Cambia el ancho a 83.3333% (10/12) -->
        <div class="modal-content">
            <!-- Encabezado del Modal -->
            <div class="modal-header">
                <h5 class="modal-title">Acerca de</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Contenido del Modal -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            <img src="/storage/{{$configGlobal->logo}}" alt="Logo"  style="max-width:130px"><br><br>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <p>
                            <b>Version: 1.0</b> 1 <br>
                            <b>Nit</b>  <br>
                            <b>Razón social</b> <br>
                            <b>Dirección</b>  <br>
                            <b>Telefono</b>  <br>
                            <b>Numero de registro</b> 024324378 <br>
                            <b>Licencia valida</b> 
                        </p>    
        
                        <br>
                        <div class="terminos">
                            <div class="content">
                                {!! $configGlobal->politicas_de_privacidad !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie del Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>