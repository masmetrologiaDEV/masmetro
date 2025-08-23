<style>
#minicalendar {
    width: 100%; /* que se ajuste siempre */
    max-width: 250px; /* límite en desktop */
    height: auto;
    overflow: hidden;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 12px;
    margin: 0 auto 15px auto;
}

#minicalendar .fc-scroller {
    overflow: hidden !important;
    height: auto !important;
}

#minicalendar .fc-toolbar {
    margin-bottom: 0;
    padding-bottom: 0;
}

#minicalendar .fc-day-header,
#minicalendar .fc-day-number {
    padding: 2px;
    text-align: center;
}

#minicalendar .fc-row {
    min-height: unset !important;
}

/* Layout flexible */
.calendar-row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.calendar-row > [class*="col-"] {
    display: flex;
    flex-direction: column;
    flex: 1 1 100%;
}

.calendar-row .x_panel {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Lista scrollable */
.lista-scroll {
    margin-top: 10px;
    padding-left: 0;
    list-style: none;
    max-height: 150px;
    overflow-y: auto;
}

.lista-scroll li {
    background: #f9f9f9;
    border: 1px solid #ddd;
    padding: 8px 12px;
    margin-bottom: 6px;
    border-radius: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
}

.lista-scroll li button {
    margin-left: 10px;
}

.contenedor-lista {
    min-height: 100px;
    position: relative;
}

.btn-block {
    width: 140px;
    text-align: left;
}

.lista-scroll .item-lista {
    font-size: 13px;
    background: #f8f9fa;
    padding: 6px 10px;
    margin-bottom: 5px;
    border-radius: 5px;
    border: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.lista-scroll .item-lista button {
    margin-left: 10px;
}

td {
    vertical-align: top;
    width: 33%;
}

.fc-agenda-view .fc-time-grid .fc-slats td {
    text-align: left;
    padding-left: 8px;
    font-weight: 500;
    color: #444;
}

/* 📱 Responsive */
@media (max-width: 768px) {
    #minicalendar {
        max-width: 100%;
    }

    .calendar-row {
        flex-direction: column;
    }

    .calendar-row > [class*="col-"] {
        flex: 1 1 100%;
    }

    #calendar {
        min-height: 400px;
    }
}

@media (min-width: 769px) {
    .calendar-row > .col-md-2 {
        flex: 0 0 250px;
        max-width: 250px;
    }
    .calendar-row > .col-md-10 {
        flex: 1;
    }
}
</style>

<!-- page content -->
<div class="right_col" role='main'>
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Programacion de Operaciones</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <button class="btn btn-primary btn-xs" onclick="calendarios();"><i class="fa fa-calendar"></i> Calendarios
                        </button>
                    </div>
                </div>
            </div>
            <div class="row calendar-row">
               <div class="col-md-2 col-sm-4 col-xs-12">
    <div class="x_panel">
        <div class="x_content">
            <div id="minicalendar"></div>

            <!-- Accordion Treeview Compacto -->
            <div class="accordion-tree">

                <div class="accordion-section collapsed">
                    <div class="accordion-header autos">Autos</div>
                    <div class="accordion-body">
                        <?php foreach ($autos as $auto): ?>
                        <div class="accordion-item"><?= $auto->name; ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="accordion-section collapsed">
                    <div class="accordion-header ejecutivos">Técnicos</div>
                    <div class="accordion-body">
                        <?php foreach ($users as $user): ?>
                        <div class="accordion-item" style="background-color: <?= $user->color; ?>;" id='selectUsuario'>
                            <?= $user->Nombre; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="accordion-section collapsed">
                    <div class="accordion-header equipos">Patrones</div>
                    <div class="accordion-body">
                        <?php foreach ($patrones as $patron): ?>
                        <div class="accordion-item"><?= $patron->nombre; ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<style>
.accordion-tree { font-family: sans-serif; }
.accordion-section { margin-bottom: 10px; border-radius: 4px; overflow: hidden; }
.accordion-header { padding: 6px 10px; cursor: pointer; color: white; font-weight: bold; border-radius: 4px; }
.accordion-body { display: none; padding-left: 10px; margin-top: 9px; }
.accordion-item { padding: 4px 8px; margin: 2px 0; border-radius: 4px; cursor: pointer; background-color: #f0f0f0; }

.accordion-section.collapsed .accordion-body { display: none; }
.accordion-section:not(.collapsed) .accordion-body { display: block; }

.autos { background-color: #f7c; }
.ejecutivos { background-color: #0a7; }
.equipos { background-color: #6c9; }
</style>

<script>
document.querySelectorAll('.accordion-header').forEach(header => {
    header.addEventListener('click', () => {
        const section = header.parentElement;
        section.classList.toggle('collapsed');
    });
});
</script>

                <div class="col-md-10 col-sm-4 col-xs-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <div id="calendar"></div>
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
<!-- calendar modal -->
<div id="modalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="testmodal" style="padding: 20px;">
                    <form id="antoform" class="form-horizontal" role="form">
                        <div class="form-group">
                            <input type="text" id="asunto" class="form-control" placeholder="Introduce el título del evento...">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Desde:</label>
                            <div class='col-sm-9 input-group date' id='timeInicia'>
                                <input id="inicia" type='text' class="form-control" placeholder="Fecha y Hora" />
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Hasta:</label>
                            <div class='col-sm-9 input-group date' id='timeTermina'>
                                <input id="termina" type='text' class="form-control" placeholder="Fecha y Hora"/>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="allDay" value="1">
                            <label class="form-check-label" for="allDay" >Todo el día</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="repeatEvent"> 
                            <label class="form-check-label" for="repeatEvent"  value="1">Se repite</label>
                        </div>
                        <div class="form-group">
                            <table id="tblTecnicos" class="data table table-striped no-margin" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td>
                                            <div class="contenedor-lista">
                                                <button onclick="buscarTecnicos();" type="button" class="btn btn-primary btn-xs btn-block">
                                                <i class="fa fa-plus"></i> Agregar Técnico
                                                </button>
                                                <ul id="listaTecnicos" class="lista-scroll"></ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="contenedor-lista">
                                                <button onclick="buscarPatrones();" type="button" class="btn btn-primary btn-xs btn-block">
                                                <i class="fa fa-plus"></i> Agregar Patrón
                                                </button>
                                                <ul id="listaPatrones" class="lista-scroll"></ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="contenedor-lista">
                                                <button onclick="buscarAutos();" type="button" class="btn btn-primary btn-xs btn-block">
                                                <i class="fa fa-plus"></i> Agregar Auto
                                                </button>
                                                <ul id="listaAutos" class="lista-scroll"></ul>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="form-group">
                            <label>¿Quién?</label>
                            <input type="text" class="form-control" placeholder="Nombre" id="quien">
                        </div>
                        <div class="form-group">
                            <label>¿Dónde?</label>
                            <button type="button" class="btn btn-link">Mostrar en el mapa</button>
                            <input type="text" class="form-control" placeholder="Ubicación" id="ubicacion">
                        </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" onclick="validar()" class="btn btn-primary">Agendar</button>
            </div>
        </div>
    </div>
</div>
<div id="modalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            <div id="testmodal" style="padding: 20px;">
               <form id="antoform" class="form-horizontal" role="form">
                  <div class="form-group">
                     <h4 class="modal-title" id="modalViewTitle"></h4>
                  </div>
                  <div class="form-group">
                     <label class="control-label">Desde:</label>
                     <div class='col-sm-9 input-group date' id='modalViewInicia'>
                        <label class="control-label" id="modalViewInicia"></label>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label">Hasta:</label>
                     <div class='col-sm-9 input-group date' id='modalViewTermina'>
                        <label class="control-label" id="modalViewTermina"></label>
                     </div>
                  </div>
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="allDay" value="1">
                     <label class="form-check-label" for="allDay" >Todo el día</label>
                  </div>
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="repeatEvent"> 
                     <label class="form-check-label" for="repeatEvent"  value="1">Se repite</label>
                  </div>
                  <div class="form-group">
                     <table id="tblTecnicos" class="data table table-striped no-margin" style="width: 100%;">
                        <thead>
                           <tr>
                              <td>
                                 <div class="contenedor-lista">
                                    <button  type="button" class="btn btn-primary btn-xs btn-block">
                                    <i class="fa fa-plus"></i> Agregar Técnico
                                    </button>
                                    <ul id="listaTecnicosRecursos" class="lista-scroll"></ul>
                                 </div>
                              </td>
                              <td>
                                 <div class="contenedor-lista">
                                    <button  type="button" class="btn btn-primary btn-xs btn-block">
                                    <i class="fa fa-plus"></i> Agregar Patrón
                                    </button>
                                    <ul id="listaPatronesRecursos" class="lista-scroll"></ul>
                                 </div>
                              </td>
                              <td>
                                 <div class="contenedor-lista">
                                    <button type="button" class="btn btn-primary btn-xs btn-block">
                                    <i class="fa fa-plus"></i> Agregar Auto
                                    </button>
                                    <ul id="listaAutosRecursos" class="lista-scroll"></ul>
                                 </div>
                              </td>
                           </tr>
                        </thead>
                     </table>
                  </div>
                  <div class="form-group">
                     <label class="control-label">¿Quién?:</label>
                     <div class='col-sm-9 input-group ' id='modalViewQuien'>
                        <label class="control-label" id="modalViewQuien"></label>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label">¿Dónde?:</label>
                     <div class='col-sm-9 input-group ' id='modalViewUbicacion'>
                        <label class="control-label" id="modalViewUbicacion"></label>
                     </div>
                  </div>
            </div>
         </div>
         <div class="modal-footer">
         <button id="modalCancel" onclick="borrarEvento()" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
         <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>
<!-- /calendar modal -->
<div id="mdlTecnicos" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Seleccionar Usuario</h4>
         </div>
         <div class="modal-body">
            <form>
               <table id="tblTecnicos" class="data table table-striped no-margin">
                  <thead>
                     <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Opciones</th>
                     </tr>
                  </thead>
                  <tbody></tbody>
               </table>
            </form>
         </div>
      </div>
   </div>
</div>
<div id="mdlPatrones" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Seleccionar Patrones</h4>
            </div>
            <div class="modal-body">
                <form>
                    <table id="tblPatrones" class="data table table-striped no-margin">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="mdlAutos" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Seleccionar Autos</h4>
            </div>
            <div class="modal-body">
                <form>
                    <table id="tblAutos" class="data table table-striped no-margin">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Placa</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="mdlCalendar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Contenido -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Calendarios</h4>
      </div>
      <div class="modal-body">
        <form id="frmCalendar">
          <div class="form-group">
            <label for="calendarName">Calendar Name</label>
            <input type="text" class="form-control" id="calendarName" placeholder="Enter calendar name">
          </div>
          <div class="form-group">
            <label>Select Color</label><br>
            <span class="color-circle" data-color="#d9534f" style="background:#d9534f;"></span>
            <span class="color-circle" data-color="#337ab7" style="background:#337ab7;"></span>
            <span class="color-circle" data-color="#5cb85c" style="background:#5cb85c;"></span>
            <span class="color-circle" data-color="#f0ad4e" style="background:#f0ad4e;"></span>
            <span class="color-circle" data-color="#5bc0de" style="background:#5bc0de;"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnSave">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
<!-- jQuery -->
<script src=<?= base_url("template/vendors/jquery/dist/jquery.min.js"); ?>></script>
<!-- Bootstrap -->
<script src=<?= base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js"); ?>></script>
<!-- FastClick -->
<script src=<?= base_url("template/vendors/fastclick/lib/fastclick.js"); ?>></script>
<!-- NProgress -->
<script src=<?= base_url("template/vendors/nprogress/nprogress.js"); ?>></script>
<!-- FullCalendar -->
<script src=<?= base_url("template/vendors/moment/min/moment.min.js"); ?>></script>
<script src=<?= base_url("template/vendors/fullcalendar/dist/fullcalendar.min.js"); ?>></script>
<script src=<?= base_url("template/vendors/fullcalendar/dist/locale-all.js"); ?>></script>
<script src=<?= base_url("template/vendors/jquery.tagsinput/src/jquery.tagsinput.js") ?>></script>
<!-- bootstrap-daterangepicker -->
<script src=<?= base_url("template/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") ?>></script>
<!-- CUSTOM JS FILE -->
<script src=<?=base_url("template/js/custom/funciones.js"); ?>></script>
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>
<script src=<?= base_url("application/views/ordenes_trabajo/js/calendario.js"); ?>></script>
<script>
    $(function () {
        load();
      $("#cbreunion").click(function () {
          if ($(this).is(":checked")) {
              $("#correos").show();
          } else {
            document.getElementById('tags_1').value = '';
              $("#correos").hide();
          }
      });
    
      $('#tags_1').tagsInput({
      width: 'auto',
      defaultText: 'Correos',
    });
    });
    
    
     var cal; var minical; var idEvento;
    minical = $('#minicalendar').fullCalendar({
    header: {
        left: 'prev',  // Flecha "prev"
        center: 'title', // Título central (como "Apr 2025")
        right: 'next'   // Flecha "next"
    },
    locale: 'en', // Puedes cambiarlo a 'es' si prefieres español
    defaultView: 'month',
     dayClick: function(date, jsEvent, view) {
        $('#calendar').fullCalendar('gotoDate', date); // Cambiar la fecha en el calendario principal
        $('#calendar').fullCalendar('changeView', 'agendaWeek'); // Asegurar que esté en vista semanal
    },
    viewRender: function(view, element) {
        // Título como "Apr 2025"
        const customTitle = moment().format('MMM YYYY'); // Usa el mes actual
        $('#minicalendar .fc-center h2').text(customTitle);
    },
    height: 'auto',
    contentHeight: 'auto',
    fixedWeekCount: false,
    });
    
    
    cal = $('#calendar').fullCalendar({
    header: {
        left: 'prev,next,today',      // Botones de navegación
        center: 'title',              // Título en el centro
        right: 'day,month,agendaWeek,agendaDay,listMonth' // Opciones de vista
    },
    locale: 'en',                   // Idioma en español
    timeFormat: 'hh:mm A',           // Formato de hora
    slotLabelFormat: 'hh:mm A',    
    defaultView: 'agendaWeek',      // Vista predeterminada
    minTime: '06:00:00',           // Mostrar desde las 6 AM
    maxTime: '24:00:00',
    events: function(start, end, timezone, callback) {
        $.ajax({
            url: "<?= base_url('ordenes_trabajo/getEventos'); ?>",
            type: "POST",
            data: {
                selectUsuario: $('#selectUsuario').val(),
                selectAuto: $('#selectAuto').val(),
                selectPatron: $('#selectPatron').val(), // Obtenemos el usuario seleccionado
            },
            success: function(data) {
                //console.log("Datos crudos del servidor:", data); // 👈 Agrega esto
                var eventos = JSON.parse(data);
                eventos = eventos.map(function(ev) {
                    ev.id = ev.id_evento; // Aseguramos que el campo id esté presente
                    return ev;
                });
                callback(eventos); // Actualizamos los eventos en el calendario
            },
            error: function() {
                alert('Error al cargar los eventos.');
            }
        });
    },
    viewRender: function(view, element) {
        if (view.name === 'agendaWeek') {
            const start = moment(view.start).format('MMM D');
            const end = moment(view.end).subtract(1, 'days').format('D, YYYY'); // end is exclusive
            const customTitle = `${start} - ${end}`;
            $('#calendar .fc-center h2').text(customTitle);
        }
    },
    dayClick: function(date){
        $("#modalNewTitle").html("Reservar sala de Juntas: " + date.format("D-MMM-Y"));
        $('#inicia').val(date.format("h:mm A"));
        $('#termina').val(date.format("h:mm A"));
        dia = date.format();
        $("#modalNew").modal();
    },
    
    eventClick: function(evento){

        $("#modalViewTitle").html(evento.title + ": " + evento.start.format("D-MMM-Y"));
        $("#modalViewUsuario").html("Usuario: " + evento.user);
        $("#modalViewInicia").html("Inicia: " + evento.start.format("hh:mm A"));
        $("#modalViewTermina").html("Termina: " + evento.end.format("hh:mm A"));
        $("#modalViewDate").html("Creado: " + moment(evento.fecha).format('YYYY-MM-D h:mm:ss a'));
    
        $("#modalViewQuien").html(evento.quien);
        $("#modalViewUbicacion").html(evento.ubicacion);
    
        idEvento = evento.id;
        if(evento.usuario == "<?= $this->session->id ?>") {
            $("#modalCancel").show();
        } else {
            $("#modalCancel").hide();
        }
        
        lista_tecnicos(idEvento);
        lista_patrones(idEvento);
        lista_autos(idEvento);
        $("#modalView").modal();
    }

});

// Escuchamos el cambio del select y recargamos los eventos del calendario
$('#selectUsuario').on('change', function() {
    $('#calendar').fullCalendar('refetchEvents'); // Esto recarga los eventos con el nuevo usuario seleccionado
});
$('#selectAuto').on('change', function() {
    $('#calendar').fullCalendar('refetchEvents'); // Esto recarga los eventos con el nuevo usuario seleccionado
});
$('#selectPatron').on('change', function() {
    $('#calendar').fullCalendar('refetchEvents'); // Esto recarga los eventos con el nuevo usuario seleccionado
});

    
    function lista_tecnicos(id) {
       // alert(id);
    var URL = base_url + "ordenes_trabajo/get_tecnicos_eventos";
      $('#listaTecnicosRecursos').html("");
    $.ajax({
        url: URL, // Ajusta según tu ruta
        method: 'POST',
        data: { 'id' : id },
        success: function(result) {
            var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var c = '<li class="item-lista">'
                    + elem.name
                    + '</li>';
    
                    $('#listaTecnicosRecursos').append(c);
                });
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar técnicos:', error);
        }
    }); 
    }
    function lista_patrones(id) {
    var URL = base_url + "ordenes_trabajo/get_patrones_eventos";
      $('#listaPatronesRecursos').html("");
    $.ajax({
        url: URL, // Ajusta según tu ruta
        method: 'POST',
        data: { 'id' : id },
        success: function(result) {
            var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var c = '<li class="item-lista">'
                    + elem.name
                    + '</li>';
    
                    $('#listaPatronesRecursos').append(c);
                });
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar técnicos:', error);
        }
    }); 
    }
    function lista_autos(id) {
    var URL = base_url + "ordenes_trabajo/get_autos_eventos";
      $('#listaAutosRecursos').html("");
    $.ajax({
        url: URL, // Ajusta según tu ruta
        method: 'POST',
        data: { 'id' : id },
        success: function(result) {
            var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var c = '<li class="item-lista">'
                    + elem.name
                    + '</li>';
    
                    $('#listaAutosRecursos').append(c);
                });
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar técnicos:', error);
        }
    }); 
    }
    
    function borrarEvento(){
    
    $.ajax({
        type: "POST",
        url: '<?= base_url('agenda/borrarEvento') ?>',
        data: { 'id' : idEvento },
        success: function(result){
          if(result == "1"){
            cal.fullCalendar('removeEvents',idEvento);
          }
        },
        error: function(data){
          alert("Error");
          console.log(data);
        },
      });
    }
    
    $('.date').datetimepicker({
      format: 'hh:mm A'
    });
    
</script>
</body>
</html>