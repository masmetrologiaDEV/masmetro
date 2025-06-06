<!-- page content -->
<div class="right_col" role="main">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Catalogo de Requisitores</h2>
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
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="table-responsive">
                                <table id="tblRequisitores" class="table table-striped">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">Requisitores</th>
                                            <th class="column-title"></th>
                                            <th class="column-title">QR Consumo Interno</th>
                                            <th class="column-title">QR Venta</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="table-responsive">
                                <table id="tblAprobadores" class="table table-striped">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">Aprobadores</th>
                                            <th class="column-title"></th>
                                            <th class="column-title">Requisitores a cargo</th>
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
</div>
<!-- /page content -->





<!-- MODALS -->

<div id="mdl" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="mdl-titulo">Requisitores</h4>
            </div>
            <div class="modal-body">
            <form>
                <table id="tblRequisitoresACargo" class="table table-striped">
                    <thead>
                        <tr class="headings">
                            <th style="width: 10%;" class="column-title">Requisitor</th>
                            <th class="column-title"></th>
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
<!-- JS FILE -->
<script src=<?= base_url("application/views/ordenes_compra/js/catalogo_requisitores.js"); ?>></script>
<script>
    var uid = '<?= $this->session->id ?>';
    var adm_ser = '<?= $this->session->privilegios['administrar_servicios'] ?>';

    $(function(){
        load();
    });


</script>
</body>
</html>
