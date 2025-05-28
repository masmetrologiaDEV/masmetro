<!-- page content -->
<style type="text/css">
    #canvas {
    border: 1px solid black;
    width: 250;
    height: 20vh;
}

.result{
    background-color: green;
    color:#fff;
    padding:20px;
  }
  .row{
    display:flex;
  }
</style>

<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Calidad</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="form" method="POST" action=<?= base_url('calidad/registrar') ?> class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">   
                            
                            <div class="item form-group">
                                
                                  
                                    <div id="reader"></div>
                                    
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Id Equipo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12" id="result">
                                    <input style="text-transform: uppercase;" id="id_equipo" class="form-control col-md-7 col-xs-12" name="id_equipo" placeholder="" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tecnico <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select required="required" class="select2_single form-control" name="tecnico">
                                        <?php foreach ($usuarios as $elem) { ?>
                                            <option value=<?= $elem->id ?>><?= $elem->user ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Carga de baterias <span class="required">*</span></label>
                                      <input class="form-check-input" type="radio" name="baterias" id="baterias" value="SI" >
                                      <label class="form-check-label" for="gridRadios1">
                                        Si
                                      </label>
                                      <input class="form-check-input" type="radio" name="baterias" id="baterias" value="NO" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No
                                      </label>
                                      <input class="form-check-input" type="radio" name="baterias" id="baterias" value="N/A" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No Aplica
                                      </label>
                            </div>

                            <div class="item form-group">
                                
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Enciende/Apaga <span class="required">*</span></label>
                                      <input class="form-check-input" type="radio" name="enAp" id="enAp" value="SI" >
                                      <label class="form-check-label" for="gridRadios1">
                                        Si
                                      </label>
                                      <input class="form-check-input" type="radio" name="enAp" id="enAp" value="NO" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No
                                      </label>
                                      <input class="form-check-input" type="radio" name="enAp" id="enAp" value="N/A" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No Aplica
                                      </label>
                            </div>

                            <div class="item form-group">
                                
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Piezas Completas<span class="required">*</span></label>
                                      <input class="form-check-input" type="radio" name="piezas" id="piezas" value="SI" >
                                      <label class="form-check-label" for="gridRadios1">
                                        Si
                                      </label>
                                      <input class="form-check-input" type="radio" name="piezas" id="piezas" value="NO" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No
                                      </label>
                                      <input class="form-check-input" type="radio" name="piezas" id="piezas" value="N/A" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No Aplica
                                      </label>
                            </div>

                            <div class="item form-group">
                                
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Alimentador de Corriente <span class="required">*</span></label>
                                      <input class="form-check-input" type="radio" name="alimentador" id="alimentador" value="SI" >
                                      <label class="form-check-label" for="gridRadios1">
                                        Si
                                      </label>
                                      <input class="form-check-input" type="radio" name="alimentador" id="alimentador" value="NO" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No
                                      </label>
                                      <input class="form-check-input" type="radio" name="alimentador" id="alimentador" value="N/A" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No Aplica
                                      </label>
                            </div>

                             <div class="item form-group">
                                
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Empaque Completo <span class="required">*</span></label>
                                      <input class="form-check-input" type="radio" name="empaque" id="empaque" value="SI" >
                                      <label class="form-check-label" for="gridRadios1">
                                        Si
                                      </label>
                                      <input class="form-check-input" type="radio" name="empaque" id="empaque" value="NO" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No
                                      </label>
                                      <input class="form-check-input" type="radio" name="empaque" id="empaque" value="N/A" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No Aplica
                                      </label>
                            </div>

                             <div class="item form-group">
                                
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Accesorios Completos <span class="required">*</span></label>
                                      <input class="form-check-input" type="radio" name="accesorios" id="accesorios" value="SI" >
                                      <label class="form-check-label" for="gridRadios1">
                                        Si
                                      </label>
                                      <input class="form-check-input" type="radio" name="accesorios" id="accesorios" value="NO" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No
                                      </label>
                                      <input class="form-check-input" type="radio" name="accesorios" id="accesorios" value="N/A" >
                                      <label class="form-check-label" for="gridRadios1">
                                        No Aplica
                                      </label>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Foto <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="foto1" class="form-control col-md-7 col-xs-12" name="foto1" placeholder="" required="required" type="file">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Foto <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="foto2" class="form-control col-md-7 col-xs-12" name="foto2" placeholder="" required="required" type="file">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Comentarios <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea style="text-transform: uppercase;" id="comentarios" class="col-xs-5" name="comentarios" placeholder="" ></textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Firma <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="signature-pad" class="signature-pad" >
                                        <div class="signature-pad--body">
                                          <canvas id="canvas"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="pacient_id" value="">
                            <input type="hidden" name="base64" value="" id="base64">
                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="saveandfinish" type="submit" class="btn btn-success">Registrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

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
<script src=<?= base_url("template/vendors/jquery/dist/jquery.min.js") ?>></script>
<!-- Bootstrap -->
<script src=<?= base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js") ?>></script>
<!-- FastClick -->
<script src=<?= base_url("template/vendors/fastclick/lib/fastclick.js") ?>></script>
<!-- NProgress -->
<script src=<?= base_url("template/vendors/nprogress/nprogress.js") ?>></script>
<!-- validator -->
<script src=<?= base_url("template/vendors/validator/validator.js") ?>></script>

<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("application/views/calidad/js/firma.js"); ?>></script>
<script src=<?= base_url("application/views/calidad/js/qrcode.min.js"); ?>></script>


<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>



<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>

<script src="<?= base_url('application/views/calidad/js/calidad.js') ?>"></script>





</body>
</html>
