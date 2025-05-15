<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Catalogo de Equipos</h2>
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
                     <form method="POST" action=<?= base_url('basculas/exportarBasculas') ?> class="form-horizontal form-label-left" novalidate enctype="multipart/form-data" onkeypress="return anular(event)">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <p style="display: inline;">
                           No. Inventario:
                           <input type="radio" class="flat" name="rbBusqueda" id="rbFolio" value="inventario" checked />
                           No. Serie:
                           <input type="radio" class="flat" name="rbBusqueda" id="rbUsuario" value="serie" />                                  
                        </p>
                        <input id="txtBusqueda" name="txtBusqueda" style="display: inline;" type="text" >
                        <p style="display: inline; margin-right: 10px;">
                           Estatus: 
                        </p>
                        <p style="margin-left: 10px; display: inline;">
                           Ver equipos inactivos:
                           <input type="checkbox" class="flat" id="cbActivo" name="activo" />
                        </p>
                        <!--<select onchange="buscar()" style="display: inline; width: 12%; margin-right: 10px;" required="required" class="select2_single form-control" id="opEstatus" name="opEstatus">
                           </select>-->
                        <button onclick="buscar()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Buscar</button>
                     </div>
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
                     <button type="submit" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Exportar </button>
                    </form>
                     <label id="lblCount" class="pull-right"></label>
                     <table id="tabla" class="table table-striped">
                        <thead>
                           <tr class="headings">
                              <th class="column-title">ID</th>
                              <th class="column-title">No. Serie</th>
                              <th class="column-title">Modelo</th>
                              <th class="column-title">Capacidad</th>
                              <th class="column-title">Estatus</th>
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

<div id="mdlBitacora" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Bitacora de Cambios</h4>
            </div>
            <div class="modal-body">
                <form>
                <table id="tblBitacora" class="data table table-striped no-margin">
                    <thead>
                        <tr>
                            <th>Accion</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Comentarios</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default btn-sm"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="mdlEquipos" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="modalEmpresaHeader">Editar Bascula</h4>
              </div>
              <form method="POST" action=<?= base_url('basculas/editar') ?> class="form-horizontal form-label-left" >
              <div class="modal-body">
              <input name="id_equipo" id="id_equipo" type="hidden" value="">
              <div class="item form-group" id="no_inventario">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="id" class="form-control col-md-7 col-xs-12" name="id" placeholder="" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group" >
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Marca <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="marca" class="form-control col-md-7 col-xs-12" name="marca" placeholder="" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group" >
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Modelo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="modelo" class="form-control col-md-7 col-xs-12" name="modelo" placeholder="" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group" >
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Serie <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="serie" class="form-control col-md-7 col-xs-12" name="serie" placeholder="" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Activo </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        <input type="checkbox" id="activo" name="activo" value="1"/>
                                    </p>
                                </div>
                            </div>
                            <div class="item form-group" id="comentarios">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Comentarios <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea required style="resize: none;" class="form-control" id="comentarios" name="comentarios" ></textarea>
                                    </div>
                                </div>
             

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Datos</button>
              </div>
              </form>
            </div>
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
<script src=<?= base_url("application/views/basculas/js/catalogo.js"); ?>></script>
<script>
    function anular(e) {
          tecla = (document.all) ? e.keyCode : e.which;
          return (tecla != 13);
     }
  </script>
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