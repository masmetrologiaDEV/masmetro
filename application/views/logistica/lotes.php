<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Catalogo de Lotes</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <a href="<?= base_url("logistica/lotes_conceptos"); ?>"><button id="btnBuscar" style="display: inline;" class="btn btn-primary btn-xs" type="button"><i class="fa fa-plus"></i> Crear Lote</button></a>  
                            <p style="display: inline;">
                                    RS:
                                    <input type="radio" class="flat" name="rbBusqueda" id="rbCodigo" value="rs"  />
                                    Cliente:
                                    <input type="radio" class="flat" name="rbBusqueda" id="rbCodigo" value="cliente"  />
                                </p>
                                <input id="txtBusqueda" style="display: inline;" type="text">
                                <button onclick="buscar()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Buscar</button>
                        <!--<button onclick="agregar()" type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Agregar Requisito </button>-->
                            <div class="table-responsive">
                                <table id="tabla" class="table table-bordered">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title text-center">Lote</th>
                                            <th class="column-title text-center">Creado</th>
                                            <th class="column-title text-center">Estatus</th>
                                            <th class="column-title text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    if($lote) { $i = 1;
                                     foreach ($lote->result() as $elem) { ?>

                                            <tr class="even pointer">
                                                <td  class="text-center"><?= $elem->id ?></td>
                                                <td  class="text-center"><?= $elem->fecha_creacion ?></td>
                                                <td style="width: 500px;"><?= $elem->estatus ?></td>
                                                <td class="text-center">
                                                <a target="_blank" href=<?= base_url("logistica/ver_lote/".$elem->id); ?>><button type="button"class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Ver </button></a>
                                                <a target="_blank" href=<?= base_url("logistica/ver_lote_pdf/".$elem->id); ?>><button type="button"class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Ver PDF</button></a>                                            
                                                </td>
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
<!-- icheck -->
<script src=<?= base_url("template/vendors/iCheck/icheck.min.js"); ?>></script>
<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>







</body>
</html>
