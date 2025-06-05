<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="icon" href="<?= base_url("template/images/logo.ico"); ?>">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MAS Metrología</title>

        <!-- Bootstrap -->
        <link href=<?= base_url("template/vendors/bootstrap/dist/css/bootstrap.css"); ?> rel="stylesheet">
        <!-- Font Awesome -->
        <link href=<?= base_url("template/vendors/font-awesome/css/font-awesome.min.css") ?> rel="stylesheet">

        <!-- PNotify -->
        <link href=<?= base_url("template/vendors/pnotify/dist/pnotify.css"); ?> rel="stylesheet">
        <link href=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.css"); ?> rel="stylesheet">
        <link href=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.css"); ?> rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href=<?= base_url("template/build/css/custom.css"); ?> rel="stylesheet">

    </head>
<body style="background: #f7f7f7;">
<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>Reloj Checador <small id="reloj"></small></h2>
                      <a style="float: right;" id="btnReloj" href="<?= base_url('inicio') ?>" style="background: transparent;" class="btn btn-default"><i class="fa fa-home"></i> Inicio</a>
                      <div class="clearfix"></div>
                  </div>
                  <div style="border: 2px solid;" class="x_content">
                  <center id="divFoto">
                    <img width="90%" src="<?= base_url('template/images/logo.png') ?>"></img>
                    <div id="camera"></div>
                    <div id="forma">
                        <div class="col-md-offset-3 col-md-6">
                        <h3>No. de Empleado</h3>
                        <input id="id_usuario" name="id_usuario" type="hidden">
                        <input id="tipo" name="tipo" type="hidden">
                        <input maxlength="120" style="text-transform: uppercase;" id="no_empleado" class="form-control col-md-7 col-xs-12" name="no_empleado" type="text">
                        </div>
                        <button id="btnChecar" onclick="registrarEntrada();" style="margin-top: 10px;" type="button" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Checar Entrada </button>
                    </div>
                    <div style='display: none;' id="infoUsuario">
                        <h1 id='nombre'></h1>
                        <h1 id='conteo'></h1>
                    </div>
                  </center>
                  </div>
              </div>
          </div>

          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 id="fecha"></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <div class="table-responsive">
                    <table id="tabla" class="table table-striped">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">#</th>
                                <th class="column-title">Foto</th>
                                <th class="column-title">Nombre</th>
                                <th class="column-title">Tipo</th>
                                <th class="column-title">Hora</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        if(FALSE) {
                            foreach ($empresas->result() as $elem) { ?>

                                <tr class="even pointer">
                                    <td><a href="<?= base_url('empresas/ver/'.$elem->id) ?>"><img src=<?= base_url('data/empresas/fotos/'.$elem->foto); ?> class="avatar" alt="Avatar"></a></td>
                                    <td><?= $elem->nombre ?></td>
                                    <td><?= $elem->razon_social ?></td>
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
<!-- /page content -->


        <!-- MODAL -->
        <div id="modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Reloj Checador</h4>
              </div>
              <div class="modal-body">
              <form>
                <center>
                    <button onclick="descanso();" type="button" class="btn btn-warning btn-lg" data-dismiss="modal"><i class="fa fa-clock-o"></i> Descanso</button>
                    <button onclick="salida();" type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="fa fa-sign-out"></i> Salida</button>
                </center>
              </form>
              </div>

            </div>
          </div>
        </div>
        <!-- /MODAL -->





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
<!-- Say Cheese -->
<script src=<?= base_url("template/vendors/say-cheese/say-cheese.js"); ?>></script>
<!-- Bootstrap -->
<script src=<?= base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js"); ?>></script>
<!-- Moment -->
<script src=<?=base_url("template/vendors/moment/min/moment.min.js"); ?>></script>
<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>



<script>
    const BASE_URL = "<?= base_url() ?>";
    const USUARIO = "<?= $usuario ?>";
    const IDUSUARIO = "<?= $idusuario ?>";
</script>
<script src="<?= base_url('application/views/reloj_checador/js/checador.js') ?>"></script>






</body>
</html>
