<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Usuarios</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">Foto</th>
                                            <th class="column-title">Nombre</th>
                                            <th class="column-title">No. Empleado</th>
                                            <th class="column-title">Departamento</th>
                                            <th class="column-title">Puesto</th>
                                            <th class="column-title">Correo</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    if($usuarios) {
                                     foreach ($usuarios->result() as $elem) { ?>

                                            <tr class="even pointer">
                                                <td><a href="<?= base_url('usuarios/ver/'.$elem->id) ?>"><img src=<?= 'data:image/bmp;base64,' . base64_encode($elem->foto); ?> class="avatar" alt="Avatar"></a></td>
                                                <td>
                                                    <a><?= strtoupper($elem->User) ?></a><br/>
                                                    <?php $date = date_create($elem->ultima_sesion); ?>
                                                    <small>Ultima Sesión: <?= date_format($date, 'd/m/Y h:i A'); ?></small>
                                                </td>
                                                <td><?= $elem->no_empleado ?></td>
                                                <td><?= $elem->departamento ?></td>
                                                <td><?= $elem->puesto ?></td>
                                                <td><?= $elem->correo ?></td>
                                            </tr>
                                    <?php }
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
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>

<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
<script>
<?php
if (isset($this->session->errores)) {
    foreach ($this->session->errores as $error) {
        echo "new PNotify({ title: '" . $error['titulo'] . "', text: '" . $error['detalle'] . "', type: 'error', styling: 'bootstrap3' });";
    }
    $this->session->unset_userdata('errores');
}
if (isset($this->session->aciertos)) {
    foreach ($this->session->aciertos as $acierto) {
        echo "new PNotify({ title: '" . $acierto['titulo'] . "', text: '" . $acierto['detalle'] . "', type: 'success', styling: 'bootstrap3' });";
    }
    $this->session->unset_userdata('aciertos');
}
?>
</script>
</body>
</html>
