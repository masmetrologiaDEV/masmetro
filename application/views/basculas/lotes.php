<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Lotes Basculas</h2>
                  <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
                     <li><a class="close-link"><i class="fa fa-close"></i></a>
                     </li>
                  </ul>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="row">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_content">
                  <div class="table-responsive">
                    <a href=<?= base_url("basculas/crear_lote") ?> class="btn btn-primary btn-xs"><i class='fa fa-plus'></i> Crear Lote</a>
                     <label id="lblCount" class="pull-right"></label>
                     <table id="tabla" class="table table-striped">
                        <thead>
                           <tr class="headings">
                              <th class="column-title">No. Lote</th>
                              <th class="column-title">Fecha Creacion</th>
                              <th class="column-title">Fecha Entrega</th>
                              <th class="column-title">Cliente</th>
                              <th class="column-title">Opciones</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /page content -->
<div id="mdlAccesorios" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Accesorios</h4>
              </div>
              <div class="modal-body">
              <form>
                <table id="tblAccesorios" class="table table-striped no-margin">
                  <thead>
                    <tr>
                      <th>Tipo</th>
                      <th>No. Inventario</th>
                      <th>Modelo</th>
                      <th>Estatus</th>
                      <th>Opción</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </form>
              </div>
              <div class="row" style="overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <table id="tblLoteAccesorios" class="table table-striped">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">Bascula</th>
                                        <th class="column-title">Tipo</th>
                                        <th class="column-title">Accesorio</th>
                                        <th class="column-title">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            </div>
            
        
        <br>
          </div>
        </div>

<!-- footer content -->
<footer>
   <div class="pull-right">
      Equipo de Desarrollo | MAS Metrología
   </div>
   <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<!-- jQuery -->
<script src=<?= base_url("template/vendors/jquery/dist/jquery.min.js"); ?>></script>
<!-- Bootstrap -->
<script src=<?= base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js"); ?>></script>
<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
<!-- iCheck -->
<script src=<?= base_url("template/vendors/iCheck/icheck.min.js"); ?>></script>
<!-- formatCurrency -->
<script src=<?= base_url("template/vendors/formatCurrency/jquery.formatCurrency-1.4.0.js"); ?>></script>
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>
<!-- JS FILE -->
<script src=<?= base_url("application/views/basculas/js/lotes.js"); ?>></script>
<script>
  $(document).ready(function(){
        load();
        eventos();
    });
  function eventos(){

        $( '#txtBusqueda' ).on( 'keypress', function( e ) {
            if( e.keyCode === 13 ) {
                buscar();
            }
        });
    }
</script>
</body>
</html>