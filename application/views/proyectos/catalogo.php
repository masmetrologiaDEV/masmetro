<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Catalogo Proyectos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    <div class="table-responsive">
                    		<a href="<?= base_url('proyectos/nuevo_proyecto');?>" class="btn btn-default btn-xs"><i class='fa fa-asterisk'></i> Nuevo</a>

                        <table class="table table-bordered datatable table-hover">
			<thead>
      <th></th>
      <th>Usuario </th>
			<th>Nombre </th>
			<th>Descripcion</th>
            <th>Estatus</th>
      <th>Duracion</th>
      <th>Creacion</th>
      <th>Fecha inicio</th>
      <th>Fecha final</th>
            <th></th>
			</thead>
            <tbody>
		<?php
            foreach($proyecto->result() as $row){
        $datetime1 = new DateTime($row->fecha_inicio);
$datetime2 = new DateTime($row->fecha_final);
$interval = $datetime1->diff($datetime2);

                ?>
                
				<tr>
					<td style="width: 100px; ">
  <a href="<?=base_url("proyectos/ver/".$row->id);?>" class="btn btn-default btn-xs"><i class='fa fa-sitemap'></i> Ver diagrama</a>
          </td>
          <td><?= $row->nombre?></td>
					<td><?= $row->name?></td>
					<td><?= $row->description?></td>
					<td><?= $row->status?></td>
					<td><?= $interval->days?></td>
					<td><?= $row->created_at?></td>
					<td><?= $row->fecha_inicio?></td>
                    <td><?= $row->fecha_final?></td>
				<td>
                <a class="btn btn-warning btn-xs">Editar</a>
                <a class="btn btn-danger btn-xs">Eliminar</a>
				</td>
				</tr>
<?php
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
<script src=<?= base_url("application/views/ordenes_compra/js/catalogo_po.js"); ?>></script>
<script>

    $(function(){
        load();
    });

    
</script>
</body>
</html>
