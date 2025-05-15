
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Agregar Proyecto</h2>
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
                        
<form class="form-horizontal" method="post" id="addproduct" action="<?= base_url('proyectos/registrar') ?>"role="form">
  <div class="item form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="item form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
    <div class="col-md-6">
      <textarea name="description" required class="form-control" id="lastname" placeholder="Descripcion"></textarea>
    </div>
  </div>

  
  <div class="item form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha inicio*</label>
    <div class="col-md-6">
      <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" placeholder="Duracion (Total de Dias/Semanas/Meses)">
    </div>
  </div>
  <div class="item form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha limite*</label>
    <div class="col-md-6">
      <input type="date" name="fecha_final" class="form-control" id="fecha_final" placeholder="Duracion (Total de Dias/Semanas/Meses)">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Proyecto</button>
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

< <!-- jQuery -->
    <script src=<?=base_url("template/vendors/jquery/dist/jquery.min.js"); ?>></script>
    <!-- Bootstrap -->
    <script src=<?=base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js"); ?>></script>
    <!-- FastClick -->
    <script src=<?=base_url("template/vendors/fastclick/lib/fastclick.js"); ?>></script>
    <!-- NProgress -->
    <script src=<?=base_url("template/vendors/nprogress/nprogress.js"); ?>></script>
    <!-- morris.js -->
    <script src=<?=base_url("template/vendors/raphael/raphael.min.js"); ?>></script>
    <script src=<?=base_url("template/vendors/morris.js/morris.min.js"); ?>></script>
    <!-- bootstrap-progressbar -->
    <script src=<?=base_url("template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"); ?>></script>
    <!-- bootstrap-daterangepicker -->
    <script src=<?=base_url("template/vendors/moment/min/moment.min.js"); ?>></script>
    <script src=<?=base_url("template/vendors/bootstrap-daterangepicker/daterangepicker.js"); ?>></script>

    <!-- icheck -->
    <script src=<?= base_url("template/vendors/iCheck/icheck.min.js"); ?>></script>

    <!-- jQuery Tags Input -->
    <script src=<?= base_url("template/vendors/jquery.tagsinput/src/jquery.tagsinput.js") ?>></script>

    <!-- PNotify -->
    <script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
    <script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
    <script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
    
  

<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>

</body>
</html>
