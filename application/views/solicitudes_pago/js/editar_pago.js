function load() {
   
    cargarArchivos();
    iniciar_daterangepicker();
}
function mdlComentarios() {
    $('#mdlComentarios').modal();
}
function uploadPreFactura(){
    var files = document.getElementById("prefactura").files;
    var file = files[0];
    var URL = base_url + 'solicitudes_pago/uploadPreFactura';
    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append("id", id);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", URL);
    ajax.send(formdata);
    ajax.onload = function(){
      window.location.reload();
    }
  }
function uploadFactura(){
    var files = document.getElementById("factura").files;
    var file = files[0];
    var URL = base_url + 'solicitudes_pago/uploadFactura';
    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append("id", id);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", URL);
    ajax.send(formdata);
    ajax.onload = function(){
      window.location.reload();
    }
  }  
  function uploadXML(){
    var files = document.getElementById("xml").files;
    var file = files[0];
    var URL = base_url + 'solicitudes_pago/uploadXML';
    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append("id", id);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", URL);
    ajax.send(formdata);
    ajax.onload = function(){
      window.location.reload();
    }
  }
  function uploadComplemento(){
    var files = document.getElementById("complemento").files;
    var file = files[0];
    var URL = base_url + 'solicitudes_pago/uploadComplemento';
    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append("id", id);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", URL);
    ajax.send(formdata);
    ajax.onload = function(){
      window.location.reload();
    }
  }
  function uploadComprobante(){
    var files = document.getElementById("comprobante").files;
    var file = files[0];
    var URL = base_url + 'solicitudes_pago/uploadComprobante';
    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append("id", id);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", URL);
    ajax.send(formdata);
    ajax.onload = function(){
      window.location.reload();
    }
  }
  function cargarArchivos(){
        $('#tablaArchivos tbody tr').remove();
        var URL = base_url + "empresas/ajax_getArchivos";        
        $.ajax({
            type: "POST",
            url: URL,
            data: { empresa : ID_EMPRESA},
            success: function (response) {
                if(response){
                    var rs = JSON.parse(response);
                    var tabla = $('#tablaArchivos tbody')[0];

                    $.each(rs, function (i, elem) { 
                        var row = tabla.insertRow();

                        row.insertCell().innerHTML = tabla.rows.length;
                        row.insertCell().innerHTML = "<img style='border: 0px;' src='" + File_image(elem.nombre) + "' class='avatar'>";
                        row.insertCell().innerHTML = "<a>" + elem.nombre + "</a><br/><small>Agregado: " + moment(elem.fecha).format('YYYY-MM-D h:mm:ss a') + "</small>";
                        row.insertCell().innerHTML = "<a>" + elem.tipo + "</a>";
                        row.insertCell().innerHTML = "<a>" + elem.clave + "</a>";
                        row.insertCell().innerHTML = "<a>" + elem.User + "</a>";
                        row.insertCell().innerHTML = "<a href='" + base_url + 'data/empresas/archivos/' + ID_EMPRESA + '/' + elem.nombre + "' target='_blank' class='btn btn-primary btn-xs'><i class='fa fa-download'></i> Abrir </a>";
                    });
                }
            }
        });
    }
    function solicitarPago() {
        var tabla = document.querySelectorAll("#tablaArchivos tbody tr").length;
        var pago = $('#opTipoPago').val();
        var tipoFactura = $("input[name='cbFactura']:checked").val();
        if (pago=='') {
            alert('Seleccione tipo de pago');
        }
        else if(!document.querySelector('input[name="cbFactura"]:checked')){
            alert('Seleccione tipo de factura');
        }else if(tabla == 0){
            alert('No existen archivos fiscales');
        }
        else{
        
        var URL = base_url + 'solicitudes_pago/solicitarPago';
        if (pago) {}
        $.ajax({
            type: "POST",
            url: URL,
            data: { id : id, pago : pago, tipoFactura : tipoFactura },
            success: function (result) {
                if (result) {
                    window.location.reload();
                }
            },
        });
    }

}
function buscarContactos(){
    var URL = base_url + "solicitudes_pago/ajax_getContactos";
    $('#tblContactos tbody tr').remove();
    var idCliente = $('#btnClientes').data('id');
    
    $.ajax({
        type: "POST",
        url: URL,
        data: { id : ID_EMPRESA },
        success: function(result) {
            if(result)
            {
                var tab = $('#tblContactos tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem)
                {
                            var ren = tab.insertRow(tab.rows.length);
                            ren.insertCell().innerHTML = elem.nombre;
                            ren.insertCell().innerHTML = elem.puesto;
                            ren.insertCell().innerHTML = "<select style=' width: 50%;' class='select2_single form-control-xs' id='opTipoContacto'><option value=''></option><option value='PAGO'>Notificacion Pago</option><option value='FACTURA'>Solicitud de Factura</option><option value='REP'>Solicitud de REP/Complemento</option></select>"
                            ren.insertCell().innerHTML = "<button type='button' onclick='validarContacto("+elem.id+")' value='" + elem.id +"' class='btn btn-default btn-xs'><i class='fa fa-check'></i> Seleccionar</button>";
                });

                $('#mdlContactos').modal();
            }
            else{
                alert("Cliente no tiene definidos contactos para cotizar");
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
}

/*function seleccionarContacto(btn){
var contacto = $('#opTipoContacto').val();
 if (contacto=='') {
            alert('Seleccione tipo de contacto');
        }
        else{
    var URL = base_url + 'solicitudes_pago/seleccionarContacto';
       
        $.ajax({
            type: "POST",
            url: URL,
            data: { id : id, idContacto : btn, contacto : contacto },
            success: function (result) {
                    window.location.reload();
            },
        });
  }
}*/
function validarContacto(btn){
var contacto = $('#opTipoContacto').val();
 if (contacto=='') {
            alert('Seleccione tipo de contacto');
        }
        else{
    var URL = base_url + 'solicitudes_pago/validarContacto';
       
        $.ajax({
            type: "POST",
            url: URL,
            data: { id : id, idContacto : btn, contacto : contacto },
            success: function (result) {
                    if (result) {
                        alert('Ya existe contacto de tipo: '+contacto);

                    }else{
                        var URL = base_url + 'solicitudes_pago/seleccionarContacto';
       
                        $.ajax({
                            type: "POST",
                            url: URL,
                            data: { id : id, idContacto : btn, contacto : contacto },
                            success: function (result) {
                                    window.location.reload();
                            },
                        });
                    }
            },
        });
  }
}

function enviarSolicitud(){
    var URL = base_url + 'solicitudes_pago/enviarSolicitud';
    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id},
            success: function (result) {
                    window.location.reload();
            },
        });
}
function aceptar(){
    var URL = base_url + 'solicitudes_pago/aceptarSolicitud';
    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id},
            success: function (result) {
                window.location.reload();
            },
        });
}
function iniciar_daterangepicker() {
    $("#txtFechaAccion").daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        timePickerIncrement: 15,
        locale: {
            format: 'YYYY-MM-DD H:mm:ss'
        }
    });
}
function programar_pago(){
    var date = $('#txtFechaAccion').val();
    var URL = base_url + 'solicitudes_pago/programar_pago';

    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id, date : date},
            success: function (result) {
                window.location.reload();
            },
        });
}
function solicitar_complemento(){
    
    var URL = base_url + 'solicitudes_pago/solicitar_complemento';

    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id},
            success: function (result) {
                window.location.reload();
            },
        });
}
function aceptar_complemento(){
    
    var URL = base_url + 'solicitudes_pago/aceptar_complemento';

    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id},
            success: function (result) {
                window.location.reload();
            },
        });
}
function cancelar_pago(){
    var URL = base_url + 'solicitudes_pago/cancelar_pago';
    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id},
            success: function (result) {
                window.location.reload();
            },
        });
}
function rechazar_factura(){
    var URL = base_url + 'solicitudes_pago/rechazar_factura';
    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id},
            success: function (result) {
                window.location.reload();
            },
        });
}
function rechazar_complemento(){
    var URL = base_url + 'solicitudes_pago/rechazar_complemento';
    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id},
            success: function (result) {
                window.location.reload();
            },
        });
}
