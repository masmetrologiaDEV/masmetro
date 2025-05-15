<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2><?= $proyecto->name?></h2>
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
                     <button type="button" onclick="agregar_tarea();" class="btn btn-default btn-sm"><i class="fa fa-asterisk"></i>  Nueva tarea</button>
                     <br><br>
                     <table class="table table-bordered datatable table-hover" style="width: auto; " >
                        <thead>
                           <th></th>
                           <th>Nombre </th>
                           <?php 
                              $datetime1 = new DateTime($proyecto->fecha_inicio);
                              $datetime2 = new DateTime($proyecto->fecha_final);
                              for($i=$datetime1; $i<=$datetime2;$i->modify('+1 day')):?>
                           <th style="width: 80px;"><?= $i->format("d/m/Y")?></th>
                           <?php endfor; ?>
                        </thead>
                        <tbody>
                           <?php
                           if ($tareas) {
                           
                           foreach($tareas->result() as $item){
                           ?>
                        <tr>
                           <td style="display: inline-block;  ">
                              <button onclick="editar(<?=$item->id?>);" class="btn btn-warning btn-xs"><i class='fa fa-pencil'></i></button>
                              <a href="" class="btn btn-danger btn-xs"><i class='glyphicon glyphicon-remove'></i></a>
                              <button onclick="" class="btn btn-primary btn-xs"><i class='glyphicon glyphicon-file'></i></button>
                           </td>
                           <td><?=$item->title?></td>
                           <?php
                              $datetime1 = new DateTime($proyecto->fecha_inicio);
                              $datetime2 = new DateTime($proyecto->fecha_final);
                              $interval = $datetime1->diff($datetime2);
                              for($i=1; $i<=$interval->days; $i++):
                           ?>
                           <td style="width:10px; <?php if($item->start<=$i && $item->finish >=$i){ echo "background: $item->color; "; }?>"></td>
                              <?php endfor; ?>
                        </tr>
                        <?php

                     }
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
<div id="mdlTarea" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Agregar Tarea</h4>
         </div>
         <div class="modal-body">
            <form class="form-horizontal" method="post" id="addproduct" action="<?= base_url('proyectos/registrar_tarea') ?>"role="form">
               <input type="hidden" name="dia_id" value="<?= $proyecto->id?>">
               <div class="form-group">
                  <label for="inputEmail1" class="col-lg-2 control-label">Titulo*</label>
                  <div class="col-md-6">
                     <input type="text" name="title" class="form-control" id="name" placeholder="Titulo">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
                  <div class="col-md-6">
                     <textarea name="description" required class="form-control" id="description" placeholder="Descripcion"></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail1" class="col-lg-2 control-label">Inicio*</label>
                  <div class="col-md-6">
                     <select required="required" class="select2_single form-control" name="start" id="start">
                        <?php
                           $datetime1 = new DateTime($proyecto->fecha_inicio);
                           $datetime2 = new DateTime($proyecto->fecha_final);
                           $n=0;
                              for($i=$datetime1; $i<=$datetime2;$i->modify('+1 day')){
                            $n=$n+1;
                           ?>
                        <option value="<?= $n?>"><?= $i->format("d / m / Y")?></option>
                        <?php
                           }
                                 ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail1" class="col-lg-2 control-label">Fin*</label>
                  <div class="col-md-6">
                     <select required="required" class="select2_single form-control" name="finish" id="finish">
                        <?php
                           $datetime1 = new DateTime($proyecto->fecha_inicio);
                           $datetime2 = new DateTime($proyecto->fecha_final);
                           $n=0;
                              for($i=$datetime1; $i<=$datetime2;$i->modify('+1 day')){
                               $n=$n+1;             
                           ?>
                        <option value="<?= $n?>"><?= $i->format("d / m / Y")?></option>
                        <?php         
                           }
                              ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail1" class="col-lg-2 control-label">Color*</label>
                  <div class="col-md-6">
                     <input type="color" name="color" class="form-control" id="color" placeholder="Color">
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                     <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default btn-sm"><i class="fa fa-close"></i> Cerrar</button>
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
<script type="text/javascript">
   function agregar_tarea() {
      $('#mdlTarea').modal();
   
   }
   function editar(id) {
      $.ajax({
          type: "POST",
          url: '<?= base_url('proyectos/get_tarea') ?>',
          data: { id:id },
          success: function(result){
            if(result) {
              var res = JSON.parse(result);
              alert(JSON.stringfy(res));
              $('#name').val(res.title);
              $('#description').val(res.description);
                    $('#mdlTarea').modal();

              /*$('#name').val(res.title);
              $('#name').val(res.title);*/
            }
          },
          error: function(data){
            console.log(data);
          },
        });
   }
</script>
</body>
</html>