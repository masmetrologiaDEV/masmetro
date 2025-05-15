<?php
 $suma=null;
 ?><!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Generar Solicitud de Pago</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" >
                            <div class="table-responsive" >
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="headings">
                                            <th >Proveedor</th>
                                            <th >PO</th>
                                            <th >Estatus PO</th>
                                            <th >Credito</th>
                                            <th >Terminos de Pago</th>
                                            <th >Total</th>                                                                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($pago) {
                                       
                                        foreach ($pago as $elem) {   
                                        $suma +=$elem->total;
                                            ?>
                                                <tr class="even pointer">
                                                    <td><?= $elem->nombre ?></td>
                                                    <td><?= $elem->po ?></td>
                                                    <td><button class='btn btn-success btn-xs'></i><?= $elem->estatusPO ?></button></td>
                                                    <td><?= '$ '.number_format($elem->monto_credito)?></td>
                                                    <td><?= $elem->terminos_pago ?></td>
                                                    <td><?= '$ '.number_format($elem->total)?></td>
                                                </tr>

                                        <?php }
                                    }
                                    ?>
                                    </tbody>
                                </table> 
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">TOTAL: $ <?=number_format($suma)?></label> 
                            </div>
                        </div>
                        <button type="button" onclick='cancelar()' class="btn btn-danger btn-md"><i class="fa fa-close"></i> Cancelar</button>
                        <a href=<?= base_url("solicitudes_pago/generarSolicitud/".$idTemp); ?>><button type="button"  class="btn btn-primary btn-md pull-right"><i class="fa fa-send"></i> Generar Solicitud de Pago</button></a>
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
<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
<!-- iCheck -->
<script src=<?= base_url("template/vendors/iCheck/icheck.min.js"); ?>></script>
<!-- formatCurrency -->
<script src=<?= base_url("template/vendors/formatCurrency/jquery.formatCurrency-1.4.0.js"); ?>></script>
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>
<!-- JS FILE -->
<script src=<?= base_url("application/views/ordenes_compra/js/construccion_po.js"); ?>></script>


</body>
</html>
