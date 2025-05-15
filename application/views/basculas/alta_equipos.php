<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Alta de Equipos</h2>
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
                        <form method="POST" action=<?= base_url('basculas/registrar') ?> class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tipo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select onchange="subtipo()" required="required" class="select2_single form-control" id="opTipo" name="opTipo">
                                        <option value="BASCULA">BASCULA</option>
                                        <option value="PLATAFORMA">PLATAFORMA</option>
                                        <option value="RAMPA">RAMPA</option>
                                        <option value="CARRITO">CARRITO</option>
                                        <option value="EXTENSION">EXTENSION</option>
                                        <option value="ESCANER">ESCANER</option>
                                        <option value="IMPRESORA">IMPRESORA</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="no_inventario">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="name" class="form-control col-md-7 col-xs-12" name="id" placeholder="" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group" id="capacidad">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Capacidad <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="capacidad" class="form-control col-md-7 col-xs-12" name="capacidad" placeholder="" required="required" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="marca">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Marca <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="name" class="form-control col-md-7 col-xs-12" name="marca" placeholder="" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="modelo">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Modelo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="name" class="form-control col-md-7 col-xs-12" name="modelo" placeholder="" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="serie">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Serie <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input style="text-transform: uppercase;" id="name" class="form-control col-md-7 col-xs-12" name="serie" placeholder="" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group" id="comentarios">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Comentarios <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea style="resize: none;" class="form-control" id="comentarios" name="comentarios" required></textarea>
                                    </div>
                                </div>

                            <div id="base" class="x_title"> 
                                <h2>Base de Escaner</h2>
                                <div class="clearfix"></div>

                                <div class="item form-group" id="serie">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID Base <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input style="text-transform: uppercase;" id="name" class="form-control col-md-7 col-xs-12" name="id_base" placeholder="" required="required" type="text">
                                    </div>
                                </div>

                                <div class="item form-group" id="serie">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Serie Base<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input style="text-transform: uppercase;" id="name" class="form-control col-md-7 col-xs-12" name="serie_base" placeholder="" required="required" type="text">
                                    </div>
                                </div>

                                <div class="item form-group" id="serie">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Marca Base <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input style="text-transform: uppercase;" id="name" class="form-control col-md-7 col-xs-12" name="marca_base" placeholder="" required="required" type="text">
                                    </div>
                                </div>

                                <div class="item form-group" id="serie">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Modelo Base <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input style="text-transform: uppercase;" id="name" class="form-control col-md-7 col-xs-12" name="modelo_base" placeholder="" required="required" type="text">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Activo </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        <input type="checkbox"  name="activo" value="1" checked />
                                    </p>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Registrar</button>
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
<script src=<?= base_url("application/views/basculas/js/alta_equipos.js"); ?>></script>

<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>



<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>
  <script>

    $(function(){
      load();
    });


        </script>
</body>
</html>
