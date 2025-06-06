<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Crear Lote</h2>
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
                                <p style="display: inline;">
                                    RS:
                                    <input type="radio" class="flat" name="rbBusqueda" id="rbCodigo" value="rs"  />
                                    Cliente:
                                    <input type="radio" class="flat" name="rbBusqueda" id="rbCodigo" value="cliente"  />
                                </p>
                                <input id="txtBusqueda" style="display: inline;" type="text">
                                <button onclick="buscar()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="height: 350px; overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <table style="margin-bottom:60px;" id="tblEquipos" class="table table-striped">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">RS</th>
                                        <th class="column-title">Item ID</th>
                                        <th class="column-title">NOMBRE CORTO</th>
                                        <th class="column-title">Descripción</th>
                                        <th class="column-title">DOCUMENTO</th>
                                        <th class="column-title">EQUIPO</th>
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
        <br><br><br>
        <div class="row" style="height: 350px; overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <table id="tblLote" class="table table-striped">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">RS</th>
                                        <th class="column-title">Item ID</th>
                                        <th class="column-title">Descripción</th>
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
        <br>
         <form method="POST" action=<?= base_url('logistica/registrarLote') ?>>
            <button id="send" type="submit" class="btn btn-primary btn-sm">Crear Lote</button>
        </form>
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
<script src=<?= base_url("template/vendors/jquery/dist/jquery.min.js"); ?>></script>
<!-- Bootstrap -->
<script src=<?= base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js"); ?>></script>
<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
<!-- iCheck -->
<script src=<?= base_url("template/vendors/iCheck/icheck.min.js"); ?>></script>
<!-- jQuery Tags Input -->
<script src=<?= base_url("template/vendors/jquery.tagsinput/src/jquery.tagsinput.js") ?>></script>
<!-- formatCurrency -->
<script src=<?= base_url("template/vendors/formatCurrency/jquery.formatCurrency-1.4.0.js"); ?>></script>
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>
<!-- jquery.redirect -->
<script src=<?= base_url("template/vendors/jquery.redirect/jquery.redirect.js"); ?>></script>
<!-- CUSTOM JS FILE -->
<script src=<?=base_url("template/js/custom/funciones.js"); ?>></script>
<!-- JS FILE -->
<script src=<?= base_url("application/views/logistica/js/equipos.js"); ?>></script>
<script>
    var uid = '<?= $this->session->id ?>';

    $(function(){
        load();
    });


</script>
</body>
</html>
