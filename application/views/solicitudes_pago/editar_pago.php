<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Solicitud de Pago:
                            <?= str_pad($id, 6, "0", STR_PAD_LEFT) ?>
                        </h2>
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
                            <div class="col-md-4 col-sm-12">
                                <p class="lead" style="display: inline;">Requisitor: <small id='lblReq'><?= $pago->user?></small></p><br> <br> 
                                <p class="lead" id="lblProveedor" style="display: inline;">Proveedor: <?= $pago->nombre?></p><br>
                                <br>
                                <div id="divRMA" style="margin-top: 20px;">
                                    <p class="lead" style="display: inline; margin-right: 15px;">Credito:</p>
                                    <p class="lead" style="display: inline; margin-top: 10px; font-size: 20px;"><br><small id="lblRMA"><?='$ '.number_format($pago->monto_credito)?></small></p>
                                </div>

                            </div>                        
                            <div class="col-md-4 col-sm-12">

                                <p class="lead" style="display: inline; margin-right: 15px;">Tipo de pago: </p>
                                <?php 
                                    if ($pago->tipo_pago != null) {
                                    
                                 ?>
                                 <p class="lead" style="display: inline; margin-top: 10px; font-size: 20px;"><br><small id="lblRMA"><?=$pago->tipo_pago?></small></p>
                                 <?php
                                    }else{
                                 ?>
                                <select style=" width: 30%;" class="select2_single form-control-xs" id="opTipoPago">
                                      <option value=''></option>
                                      <option value='URGENTE'>URGENTE</option>
                                      <option value=PROGRAMADO>PROGRAMADO</option>
                                </select>
                                <?php
                                    }
                                ?>
                                    <br><br><br>
                                <div id="divRMA" style="margin-top: 20px;">
                                    <p class="lead" style="display: inline; margin-right: 15px;">Tipo Credito:</p>
                                    <p class="lead" style="display: inline; margin-top: 10px; font-size: 20px;"><br><small id="lblRMA"><?=$pago->terminos_pago?></small></p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <p class="lead" style="display: inline; margin-right: 15px;">Total de Pago: </p>
                                <p class="lead" style="display: inline; margin-top: 10px;"><br><small id="txtMetodoPago"><?='$ '.number_format($pago->total)?></small></p>
                                <br><br><br>
                                 <p class="lead" style="display: inline; margin-right: 15px;">Tipo de Factura: </p>
                                 <?php 
                                    if ($pago->tipo_factura != null) {
                                    
                                 ?>
                                 <p class="lead" style="display: inline; margin-top: 10px; font-size: 20px;"><br><small id="lblRMA"><?=$pago->tipo_factura?></small></p>
                                 <?php
                                    }else{
                                 ?>
                                      <p>
                                          PPD
                                          <input type="radio" class="flat prov" id="cbPPD" name="cbFactura" value="PPD"/>
                                          PUE
                                          <input type="radio" class="flat prov" id="cbPUE" name="cbFactura" value="PUE"/>
                                      </p>
                                      <?php
                                    }
                                ?>
                                <br><br><br>
                                <p class="lead" style="display: inline; margin-right: 15px; margin-top: 20px;">Estatus Actual: </p><br>
                                <button  class="btn btn-success btn-md" value="<?=$pago->estatus?>" id='btnEstatus' style="display: inline; margin-top: 10px;"><?=$pago->estatus?></button>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="col-md12 col-sm-12">   
                        <?php
                            if ($pago->estatus != 'PAGADO') {
                        ?>                          
                        <button onclick='cancelar_pago()' value='CANCELADA' class='btn btn-default btn-md' type='button'><i class='fa fa-close'></i> Cancelar</button>
                        <?php
                            }
                        ?>
                        <?php
                            if ($pago->estatus == 'PENDIENTE' && $pago->tipo_pago ==null && $pago->tipo_factura ==null) {
                        ?>
                        <button onclick='solicitarPago()' class='btn btn-primary btn-md pull-right' type='button'><i class='fa fa-send'></i> Guardar</button>
                        <?php
                        }else if($pago->estatus == 'PENDIENTE' && $pago->factura !=null && $pago->xml !=null  ){
                        ?>
                        <button onclick='enviarSolicitud()' class='btn btn-success btn-md pull-right' type='button'><i class='fa fa-send'></i> Enviar Solicitud</button>
                        <?php
                            }else if($pago->estatus == 'PROGRAMADA'|| $pago->estatus == 'PROGRAMADA' && $pago->comprobante_pago !=null){
                        ?>
                        <button onclick='solicitar_complemento()' class='btn btn-danger btn-md pull-right' type='button'><i class='fa fa-send'></i> Solicitar Complemento</button>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                                        <h3 style="display: inline;">Contactos</h3>
                                        <button type='button' onclick="buscarContactos()" id='btnContacto' class='btn btn-primary btn-xs pull-right solicitud'><i class='fa fa-plus'></i> Agregar</button>
                                        <div class="clearfix"></div>
                                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table id="tablaContactos" class="data table table-striped no-margin">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nombre</th>
                                                        <th class="text-center">Teléfono</th>
                                                        <th class="text-center">Correo</th>
                                                        <th class="text-center">Tipo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
                                        if ($contacto) {
                                            foreach($contacto->result() as $elem) {
                                    ?>
                                     <tr class="even pointer">
                                        <td  class="text-center"><?= $elem->nombre ?></td>
                                        <td  class="text-center"><?= $elem->telefono ?></td>
                                        <td  class="text-center"><?= $elem->correo ?></td>
                                        <td  class="text-center"><?= $elem->tipo ?></td>
                                    </tr>
                                    <?php  
                                }
                            }
                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <h3 style="display: inline;" id="lblPnlConceptos">Documentos Fiscales</h3>
                           <table id="tablaArchivos" class="table table-striped projects">
                                <thead>
                                  <tr>
                                    <th style="width: 1%">#</th>
                                    <th style="width: 5%"></th>
                                    <th>Archivo</th>
                                    <th>Tipo</th>
                                    <th>Clave</th>
                                    <th>Subido Por:</th>
                                    <th >Opciones</th>
                                  </tr>
                                </thead>
                                <tbody>                                  
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <h3 style="display: inline;" id="lblPnlConceptos">Po's</h3>
                            <table id="tabla" class="table">

                                <thead>
                                    <tr class="headings">
                                        <th class="text-center column-title">Po</th>
                                        <th class="text-center column-title">Usuario</th>
                                        <th class="text-center column-title">Tipo</th>
                                        <th class="text-center column-title">Total</th>
                                        <th class="text-center column-title">Estatus</th>
                                        <th class="text-center column-title">Aprobador</th>
                                        <th class="text-center column-title">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        foreach ($pos as $elem) {
                                    ?>
                                     <tr class="even pointer">
                                        <td  class="text-center"><a href=<?= base_url("ordenes_compra/ver_po/".$elem->idPO); ?> target='_blank'><button type='button' value='<?= $elem->idPO ?>' class='btn btn-default btn-xs'><?= $elem->idPO ?></button></a></td>
                                        <td  class="text-center"><?= $elem->requisitor ?></td>
                                        <td  class="text-center"><?= $elem->tipo ?></td>
                                        <td  class="text-center"><?= $elem->total ?></td>
                                        <td  class="text-center"><button type='button' value='<?= $elem->estatus ?>' class='btn btn-success btn-xs'><?= $elem->estatus?></button></td>
                                        <td  class="text-center"><?= $elem->aprobador ?></td>
                                        <td  class="text-center"><a href=<?= base_url("ordenes_compra/po_pdf/".$elem->idPO); ?> target='_blank'><button type="button"class="btn btn-primary btn-xs"><i class="fa fa-file"></i> Ver PDF </button></a> </td>
                                    </tr>
                                    <?php  
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
            <?php
              
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Archivos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <button  class="btn btn-success btn-xs" value="<?=$pago->estatus?>" id='btnEstatus'><?=$pago->estatus_factura?></button>
                    </div>
                    <div class="x_content">
                        <div class="row">

                            <?php
                                if ($pago->tipo_factura == 'PUE') {                                
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="btn btn-default btn-sm" for="prefactura" style="width: 130px">
                                <input accept="application/pdf" target="_blank" onchange="uploadPreFactura();" type="file" class="sr-only" id="prefactura" name="prefactura">
                                <i class="fa fa-file"></i> Subir Pre-Factura
                              </label>
                              <?php
                                if($pago->prefactura){
                              ?>
                              <span ><a target='_blank' href="<?= base_url('solicitudes_pago/getprePDF/'.$id) ?>"><img height='25px' src="<?= base_url('template/images/files/pdf.png')?>"></a>
                            </span>                
                            <?php
                                }
                            ?>                
                            </div>
                            <?php
                                }
                            ?>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="btn btn-default btn-sm" for="factura" style="width: 130px">
                                <input accept="application/pdf" target="_blank" onchange="uploadFactura();" type="file" class="sr-only" id="factura" name="factura">
                                            <i class="fa fa-file"></i> Subir Factura
                              </label>
                              <?php
                                if($pago->factura){
                              ?>
                              <span ><a target='_blank' href="<?= base_url('solicitudes_pago/getPDF/'.$id) ?>"><img height='25px' src="<?= base_url('template/images/files/pdf.png')?>"></a>
                                <div>
                                    <div style="position: absolute; left: 300px; top: -10px; width: 15%;" class="col-xs-12">
                                        <label style="display: block;">Fecha Programada de Pago </label>
                                        <?php
                                            if($pago->fecha_programada_pago){
                                        ?>
                                        <label style="display: block;"><?= $pago->fecha_programada_pago?> </label>
                                        </div>
                                        <?php
                                            }else{
                                        ?>
                                        <input type="text" class="form-control pull-right" id="txtFechaAccion">
                                    </div>
                                    <div style="position: absolute; left: 380px; top: 20px; width: 15%;" class="col-xs-12">
                                    <button onclick='programar_pago()' class='btn btn-primary btn-xs pull-right' type='button'><i class='fa fa-calendar'></i> Asignar</button>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </span>                
                            <?php
                                }
                            ?>                
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="btn btn-default btn-sm" for="xml" style="width: 130px">
                                <input accept="text/xml"  target="_blank" onchange="uploadXML();" type="file" class="sr-only" id="xml" name="xml">
                                            <i class="fa fa-file"></i> Subir XML
                              </label>
                              <?php
                                if($pago->xml){
                              ?>
                              <span ><a target='_blank' href="<?= base_url('solicitudes_pago/getXML/'.$id) ?>"><img height='25px' src="<?= base_url('template/images/files/xml.png')?>"></a>
                            </span> 
                              <?php
                                }
                            ?>      
                            </div>
                        </div>
                    </div>
                    <?php 
                        if ($this->session->privilegios['responderPago'] && $pago->estatus_factura == 'EN REVISION') {
                     ?>
                    <div class="col-md12 col-sm-12">                             
                        <button onclick='rechazar_factura()' class='btn btn-danger btn-md' type='button'><i class='fa fa-close'></i> Rechazar</button>
                        <button onclick='aceptar()' class='btn btn-success btn-md pull-right' type='button'><i class='fa fa-check'></i> Aceptada</button>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php
                
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Comprobante de Pago</h2>
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
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="btn btn-default btn-sm" for="comprobante" style="width: 200px">
                                <input accept="application/pdf"  target="_blank" onchange="uploadComprobante();" type="file" class="sr-only" id="comprobante" name="comprobante">
                                    <i class="fa fa-file"></i> Subir Comprobante de Pago
                              </label>
                              <?php
                                if($pago->comprobante_pago){
                              ?>
                              <span ><a target='_blank' href="<?= base_url('solicitudes_pago/getXML/'.$id) ?>"><img height='25px' src="<?= base_url('template/images/files/pdf.png')?>"></a>
                            </span> 
                              <?php
                                }
                            ?>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SECCION COMENTARIOS -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Comentarios </h2>

                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul id="lstComentarios" class="list-unstyled msg_list">
                            <button style="vertical-align: middle;" type="button" class="btn btn-primary btn-xs"
                                onclick="mdlComentarios()"><i class="fa fa-comment"></i> Agregar Comentario</button>
                            <?php
                            if ($comentarios) {
                                foreach ($comentarios->result() as $comm) {
                                    ?>
                            <li>
                                <a>
                                    <span class="image">
                                        <?php
                                                foreach ($comentarios_fotos->result() as $photo) {
                                                    if ($comm->usuario == $photo->usuario) {
                                                        echo '<img style="width: 65px; height: 65px;" src="data:image/bmp;base64,' . base64_encode($photo->foto) . '" alt="img" />';
                                                        break;
                                                    }
                                                }
                                                ?>
                                    </span>
                                    <span>
                                        <span>
                                            <?= $comm->User ?>
                                            <?php $date2 = date_create($comm->fecha); ?>
                                            <small>
                                                <?= date_format($date2, 'd/m/Y h:i A') ?></small>
                                        </span>
                                    </span>
                                    <span class="message">
                                        <?= $comm->comentario ?>
                                    </span>
                                </a>
                            </li>

                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>  

            <?php
              
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Complemento</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <button  class="btn btn-success btn-xs" value="<?=$pago->estatus?>" id='btnEstatus'><?=$pago->estatus_complemento?></button>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="btn btn-default btn-sm" for="complemento" style="width: 150px">
                                <input accept="application/pdf"  target="_blank" onchange="uploadComplemento();" type="file" class="sr-only" id="complemento" name="complemento">
                                    <i class="fa fa-file"></i> Subir Complemento
                              </label>
                              <?php
                                if($pago->complemento){
                              ?>
                              <span ><a target='_blank' href="<?= base_url('solicitudes_pago/getXML/'.$id) ?>"><img height='25px' src="<?= base_url('template/images/files/pdf.png')?>"></a>
                            </span> 
                              <?php
                                }
                            ?>                              
                            </div>
                        </div>
                    </div>                    
                    <?php 
                        if ($this->session->privilegios['responderPago'] && $pago->estatus_complemento == 'SOLICITADO' && $pago->complemento !=null) {
                     ?>
                    <div class="col-md12 col-sm-12">                             
                        <button onclick='rechazar_complemento()' value='CANCELADA' class='btn btn-danger btn-md' type='button'><i class='fa fa-close'></i> Rechazado</button>
                        <button onclick='aceptar_complemento()' class='btn btn-success btn-md pull-right' type='button'><i class='fa fa-check'></i> Aceptado</button>
                    </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
            <?php
                
            ?>
<!-- MODAL CONTACTO -->
<div id="mdlContactos" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Seleccionar Contacto</h4>
            </div>
            <div class="modal-body">
                <form>
                    <table id="tblContactos" class="data table table-striped no-margin">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th >Tipo</th>
                                <th style="width: 20%">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </form>
            </div>

        </div>
    </div>
</div>
            <div id="mdlComentarios" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Agregar Comentario</h4>
            </div>

            <div class="modal-body">
                <form method="POST" id="frmComentarios" action=<?=base_url('solicitudes_pago/agregarComentarioPago') ?>>

                    <label style="margin-left:15px;">Comentarios</label>
                    <div class="item form-group">
                        <div class="col-xs-12">
                            <input type="hidden" id="idPago" name="id" value=<?=$id ?>>
                            <textarea style="resize: none;" id="txtComentarios" required="required" name="comentario" class="form-control col-xs-12"></textarea>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <center>
                    <input id="btnAgregarComentario" type="submit" class="btn btn-primary" value="Agregar">
                </center>
            </div>
            </form>

        </div>
    </div>
</div>         
        </div>
    </div>
</div>
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
<script src=<?=base_url("template/vendors/jquery/dist/jquery.min.js"); ?>></script>
<!-- Bootstrap -->
<script src=<?=base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js"); ?>></script>
<!-- PNotify -->
<script src=<?=base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?=base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?=base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
<!-- iCheck -->
<script src=<?=base_url("template/vendors/iCheck/icheck.min.js"); ?>></script>
<!-- Moment -->
<script src=<?=base_url("template/vendors/moment/min/moment.min.js") ?>></script>
<!-- formatCurrency -->
<script src=<?=base_url("template/vendors/formatCurrency/jquery.formatCurrency-1.4.0.js"); ?>></script>
<!-- jQuery Tags Input -->
<script src=<?=base_url("template/vendors/jquery.tagsinput/src/jquery.tagsinput.js") ?>></script>
<!-- Custom Theme Scripts -->
<script src=<?=base_url("template/build/js/custom.js"); ?>></script>
<!-- bootstrap-wysiwyg -->
<script src=<?=base_url("template/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"); ?>></script>
<script src=<?=base_url("template/vendors/jquery.hotkeys/jquery.hotkeys.js"); ?>></script>
<script src=<?=base_url("template/vendors/google-code-prettify/src/prettify.js"); ?>></script>
<!-- CUSTOM JS FILE -->
<script src=<?=base_url("template/js/custom/funciones.js"); ?>></script>
<!-- JS FILE -->
<script src=<?=base_url("application/views/solicitudes_pago/js/editar_pago.js"); ?>></script>

<script src=<?= base_url("template/vendors/bootstrap-daterangepicker/daterangepicker.js") ?>></script>
<script>
    var UID = '<?= $this->session->id ?>';
    var id = '<?= $id ?>';
    var ID_EMPRESA = '<?= $pago->idEmpresa ?>';

    $(function () {
        load();
    });
</script>
</body>

</html>