<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="row">
         <div id="filtros" class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Filtros</h2>
                  <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
                  </ul>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  
                  <div class="row top_tiles">
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-laptop"></i></div>
                              <div class="count"><?= $laptop ?></div>
                              <h3>Laptop</h3>
                           </div>
                        
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-tv"></i></div>
                              <div class="count"><?= $desktop ?></div>
                              <h3>Desktop</h3>
                           </div>
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-tv"></i></div>
                              <div class="count"><?= $monitor ?></div>
                              <h3>Monitor</h3>
                           </div>
                        
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-print"></i></div>
                              <div class="count"><?= $impresora ?></div>
                              <h3>Impresoras</h3>
                           </div>
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-battery-full"></i></div>
                              <div class="count"><?= $bateria ?></div>
                              <h3>Baterias</h3>
                           </div>                        
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-minus-circle"></i></div>
                              <div class="count"><?= $router ?></div>
                              <h3>Routers</h3>
                           </div>
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-bars"></i></div>
                              <div class="count"><?= $switches ?></div>
                              <h3>Switch</h3>
                           </div>
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-mobile"></i></div>
                              <div class="count"><?= $celular ?></div>
                              <h3>Celular</h3>
                           </div>
                     </div>
                     <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="tile-stats">
                              <div class="icon"><i class="fa fa-cubes"></i></div>
                              <div class="count"><?= $todos ?></div>
                              <h3>Todos</h3>
                           </div>
                        </a>
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
<script src=<?= base_url("template/vendors/jquery/dist/jquery.min.js") ?>></script>
<!-- Bootstrap -->
<script src=<?= base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js") ?>></script>
<!-- FastClick -->
<script src=<?= base_url("template/vendors/fastclick/lib/fastclick.js") ?>></script>
<!-- NProgress -->
<script src=<?= base_url("template/vendors/nprogress/nprogress.js") ?>></script>
<!-- bootstrap-progressbar -->
<script src=<?= base_url("template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js") ?>></script>
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
   
   
   function closeNav() {
     if(document.getElementById("filtros").style.display == "none")
     {
       document.getElementById("tickets").className = "col-lg-9 col-md-12 col-sm-12 col-xs-12";
       $('#filtros').delay( 2000 ).fadeIn('slow');
     }
     else {
       $('#filtros').fadeOut('slow',function(){
         document.getElementById("tickets").className = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
       });
     }
   
   }
   
</script>
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>
</body>
</html>