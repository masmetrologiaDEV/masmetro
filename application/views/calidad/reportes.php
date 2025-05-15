<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Reportes</h2>
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
                        <div class="table-responsive">
                                <table id="tblUsuarios" class="table table-hover">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title text-center">No. Reporte</th>
                                            <th class="column-title text-center">Tecnico</th>
                                            <th class="column-title text-center">Id Equipo</th>
                                            <th class="column-title text-center">Fecha</th>
                                            <th class="column-title text-center">PDF</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    if($reportes) {
                                     foreach ($reportes->result() as $elem) { ?>

                                            <tr class="even pointer">
                                                <td class="text-center"><?= $elem->idCa ?></td>
                                                <td class="text-center" ><?= $elem->tecnico ?></td>
                                                <td class="text-center" style="text-transform:capitalize"><?= $elem->idEquipo ?></td>
                                                <td class="text-center"><?= $elem->fecha ?></td>
                                                <td class="text-center">
                                                <a target="_blank" href=<?= base_url("calidad/verPDF/".$elem->idCa); ?>><button type="button"class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-file"></i> Ver PDF </button></a>
                                                </td>
                                            </tr>
                                    <?php  }
                                      }
                                    ?>
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
<script src=<?= base_url("application/views/autos/js/alta_autos.js"); ?>></script>

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
