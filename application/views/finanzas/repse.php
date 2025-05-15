<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>REPSE</h2>
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
                        <form method="POST" action=<?= base_url('finanzas/registrar') ?> class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
                             <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">PDF <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pdf" class="form-control" name="pdf[]" placeholder="" required="required" type="file" accept="application/pdf" multiple>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="name">XML <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="xml" class="form-control col-md-7 col-xs-12" name="xml[]" placeholder="" required="required" type="file" accept="text/xml" multiple>
                                </div>
                            </div>
                         <div class="item form-group">
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Registrar</button>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            
                        </form>
                        <div class="table-responsive">
                                <table id="tblUsuarios" class="table table-hover">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title text-center">Nombre Empleado</th>
                                            <th class="column-title text-center">PDF</th>
                                            <th class="column-title text-center">XML</th>
                                            <th class="column-title text-center">Semana</th>
                                            <th class="column-title text-center">Fecha de subida</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    if($repse) { $i = 1;
                                     foreach ($repse->result() as $elem) { ?>

                                            <tr class="even pointer">
                                                <td class="text-center"><?= $elem->nomEmp ?></td>
                                                <td class="text-center">
                                                <a target="_blank" href=<?= base_url("finanzas/verPDF/".$elem->idRepse); ?>><button type="button"class="btn btn-warning btn-xs"><i class="fa fa-file-pdf-o"></i> Ver PDF </button></a>
                                                </td>
                                                <td class="text-center">
                                                <a target="_blank" href=<?= base_url("finanzas/verXML/".$elem->idRepse); ?>><button type="button"class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-file"></i> Ver XML </button></a>
                                                </td>
                                                <td class="text-center"><?= $elem->semana ?></td>
                                                <td class="text-center"><?= $elem->fecha ?></td>
                                            </tr>
                                    <?php $i++; }
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
