<style type="text/css">
   #map {
      height: 530px;
      width: 530px;
      position: absolute;
      top: 450px; 
      left: 250px;
   }
</style>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<!-- page content -->
<div class="right_col">
   <div class="">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Lote # <?= $lote->id; ?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="row">
                     <div class="col-md-12">
                        <p class="lead">Fecha:  <small><?= $lote->fecha_creacion ?></small></p>
                        <p class="lead">Usario entrega:  <small><?= $lote->usEntrega ?></small></p>
                        <p class="lead">Estatus: <a target="_blank"class="btn btn-success"><?= $lote->estatus ?></a></p>
                        <div style="overflow: hidden; margin: 10px;">
                        <p class="lead">Firma:
                        <img width="50%" src="<?= 'data:image/bmp;base64,' . base64_encode($lote->firma); ?>">   </p>             
                      </div>
                     </div>
                     
                     
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-8 col-sm-8 col-xs-12">
   <div id="pnlProveedores" class="x_panel">
      <div class="x_title">
         <h2>Detalles</h2>
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
            <div class="col-md-12">
               <table id="tblProveedores" class="table table-striped">
                  <thead>
                     <tr>
                        <th class="text-center">Rs</th>
                        <th class="text-center">Item</th>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Estatus</th>
                        <th class="text-center">Foto</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($lotes) { $i = 1;
                     foreach ($lotes->result() as $elem) { ?>
                        <tr class="even pointer">
                           <td class="text-center"><?= $elem->rs ?></td>
                           <td class="text-center"><?= $elem->items ?></td>
                           <td class="text-center"><?= $elem->descripcion ?></td>
                           <td class="text-center"><?= $elem->estatuslc ?></td>
                           <td class="text-center"><img width="15%" src="<?= 'data:image/bmp;base64,' . base64_encode($elem->foto); ?>"> </td>
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
      <span id="map" ></span>
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
<!-- icheck -->
<script src=<?= base_url("template/vendors/iCheck/icheck.min.js"); ?>></script>
<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
<!-- formatCurrency -->
<script src=<?= base_url("template/vendors/formatCurrency/jquery.formatCurrency-1.4.0.js"); ?>></script>
<!-- bootstrap-daterangepicker -->
<script src=<?= base_url("template/vendors/moment/min/moment.min.js") ?>></script>
<script src=<?= base_url("template/vendors/bootstrap-daterangepicker/daterangepicker.js") ?>></script>
<!-- jQuery Tags Input -->
<script src=<?= base_url("template/vendors/jquery.tagsinput/src/jquery.tagsinput.js") ?>></script>
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>
<!-- JS FILE -->
<script src=<?= base_url("application/views/compras/js/ver_pr.js"); ?>></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlE6J6TWRVoQ4PbrMxTr7Y2K8QsVtCuBM&callback=initMap&v=weekly"
   defer></script>
<script>
   var lat = <?= $lote->latitud?>;
    var lon = <?= $lote->longitud?>;
   alert(lat+lon);
   function initMap() {

     const myLatLng = { lat: lat , lng: lon };
     const map = new google.maps.Map(document.getElementById("map"), {
       zoom: 18,
       center: myLatLng,
     });
   
     new google.maps.Marker({
       position: myLatLng,
       map,
       title: "Hello World!",
     });
   }
   
   window.initMap = initMap;
</script>
</body>
</html>