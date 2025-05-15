var dia;
function load(){
    getTecnicos();
    getPatrones();
    getAutos();
}
function buscarTecnicos(){
    getTecnicos();
    var URL = base_url + "ordenes_trabajo/ajax_getUsuarios";
    $('#tblTecnicos tbody tr').remove();

    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblTecnicos tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem)
                {
                    var ren = tab.insertRow(tab.rows.length);
                    ren.dataset.id = elem.id;
                    ren.insertCell().innerHTML = elem.Nombre;                    
                    ren.insertCell().innerHTML = elem.correo;
                    ren.insertCell().innerHTML = "<button type='button' onclick='validarRecurso(\"" + elem.id + "\", \"us\")' class='btn btn-primary btn-xs' value=" + elem.id + "><i class='fa fa-plus'></i> Asignar </button>";

                });

                $('#mdlTecnicos').modal();
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
      });
}
function buscarPatrones(){
    var URL = base_url + "ordenes_trabajo/ajax_getPatrones";
    $('#tblPatrones tbody tr').remove();

    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblPatrones tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem)
                {
                    var ren = tab.insertRow(tab.rows.length);
                    ren.dataset.id = elem.id;
                    ren.insertCell().innerHTML = elem.nombre;
                    ren.insertCell().innerHTML = "<button type='button' onclick='validarRecurso(\"" + elem.id + "\", \"pt\")' class='btn btn-primary btn-xs' value=" + elem.id + "><i class='fa fa-plus'></i> Asignar </button>";
                });
            }
            $('#mdlPatrones').modal();
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
      });
}
function buscarAutos(){
    var URL = base_url + "ordenes_trabajo/ajax_getAutos";
    $('#tblAutos tbody tr').remove();

    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblAutos tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem)
                {
                    var ren = tab.insertRow(tab.rows.length);
                    ren.dataset.id = elem.id;
                    ren.insertCell().innerHTML = elem.marca;
                    ren.insertCell().innerHTML = elem.placas;
                    ren.insertCell().innerHTML = "<button type='button' onclick='validarRecurso(\"" + elem.id + "\", \"at\")' class='btn btn-primary btn-xs' value=" + elem.id + "><i class='fa fa-plus'></i> Asignar </button>";
                });
            }
            $('#mdlAutos').modal();
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
      });
}
function validarRecurso(id,tipo){
    var URL = base_url + "ordenes_trabajo/validarRecurso";
    var recurso=null;
    if (tipo=='us') {
        recurso="Tecnico";
    }else if(tipo=='pt') {
        recurso="Patron";
    }else if(tipo=='at') {
        recurso="Auto";
    }

    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id, tipo : tipo},
            success: function(result) {
                if(result)
                {
                    alert("Ya se registro "+recurso);
                }else{
                    AsignarRecurso(id,tipo);
                }
            },
            error: function(data){
                new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
                console.log(data);
            },
        });
}
function AsignarRecurso(id, tipo) {

    var URL = base_url + "ordenes_trabajo/AsignarRecurso";
    $.ajax({
            type: "POST",
            url: URL,
            data: { id : id, tipo : tipo},
            success: function(result) {
                if(result)
                {
                    getTecnicos();
                    getPatrones();
                    getAutos();
                    new PNotify({ title: 'Registro Exitoso', text: 'Registro Exitoso', type: 'success', styling: 'bootstrap3' });
                }
            },
            error: function(data){
                new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
                console.log(data);
            },
        });
    
}
function getTecnicos() {
     var URL = base_url + "ordenes_trabajo/get_tecnicos";
      $('#listaTecnicos').html("");
    $.ajax({
        url: URL, // Ajusta según tu ruta
        method: 'POST',
        success: function(result) {
            var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var c = '<li class="item-lista">'
    + elem.name
    + '<button type="button" class="btn btn-danger btn-xs" onclick="eliminarRecurso(' + elem.id + ')">'
    + '<i class="fa fa-trash"></i> </button>'
    + '</li>';

                    $('#listaTecnicos').append(c);
                });

        },
        error: function(xhr, status, error) {
            console.error('Error al cargar técnicos:', error);
        }
    });
}
function getPatrones() {
     var URL = base_url + "ordenes_trabajo/get_patrones";
      $('#listaPatrones').html("");
    $.ajax({
        url: URL, // Ajusta según tu ruta
        method: 'POST',
        success: function(result) {
            var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var c = '<li class="item-lista">'
    + elem.name
    + '<button type="button" class="btn btn-danger btn-xs" onclick="eliminarRecurso(' + elem.id + ')">'
    + '<i class="fa fa-trash"></i> </button>'
    + '</li>';

                    $('#listaPatrones').append(c);
                });

        },
        error: function(xhr, status, error) {
            console.error('Error al cargar técnicos:', error);
        }
    });
}
function getAutos() {
     var URL = base_url + "ordenes_trabajo/get_autos";
      $('#listaAutos').html("");
    $.ajax({
        url: URL, // Ajusta según tu ruta
        method: 'POST',
        success: function(result) {
            var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var c = '<li class="item-lista">'
    + elem.name
    + '<button type="button" class="btn btn-danger btn-xs" onclick="eliminarRecurso(' + elem.id + ')">'
    + '<i class="fa fa-trash"></i> </button>'
    + '</li>';

                    $('#listaAutos').append(c);
                });

        },
        error: function(xhr, status, error) {
            console.error('Error al cargar técnicos:', error);
        }
    });
}
function eliminarRecurso(id) {
    if (confirm('¿Estás seguro de que deseas eliminar?')) {
        $.ajax({
            url: base_url + "ordenes_trabajo/eliminar_tecnico",
            method: "POST",
            data: { id: id },
            success: function(response) {
                getTecnicos();
                getPatrones();
                getAutos();               
            },
            error: function() {
                alert("Error al intentar eliminar.");
            }
        });
    }
}
function paddy(num, padlen) {
    var pad = new Array(1 + padlen).join('0');
    return (pad + num).slice(-padlen);
}

function validar() {
    var iniciaHora = $('#inicia').val();
    var terminaHora = $('#termina').val();

    var i = moment(dia.split("T")[0] + " " + iniciaHora, "YYYY-MM-DD hh:mm A");
    var t = moment(dia.split("T")[0] + " " + terminaHora, "YYYY-MM-DD hh:mm A");

    if (i.isValid() && t.isValid()) {
        var inicia = i.format("YYYY-MM-DD HH:mm");
        var termina = t.format("YYYY-MM-DD HH:mm");

        alert("Inicio: " + inicia);
        alert("Termina: " + termina);

        if ($('#listaTecnicos li').length === 0) {
            alert('La lista tecnicos esta vacia.');
        } else if ($('#listaPatrones li').length === 0) {
            alert('La lista Patrones esta vacia.');
        } else if ($('#listaAutos li').length === 0) {
            alert('La lista Autos esta vacia.');
        } else if (document.getElementById("asunto").value.length == 0) {
            alert('El evento esta vacio.');
        } else if (document.getElementById("quien").value.length == 0) {
            alert('El campo quien esta vacio.');
        } else if (document.getElementById("ubicacion").value.length == 0) {
            alert('Ingresar ubicacion del evento.');
        } else {
            $.ajax({
                type: "POST",
                url: base_url + 'ordenes_trabajo/validacion',
                data: { inicia: inicia, termina: termina },
                success: function (result) {
                    if (result) {
                        alert("Sala Ocupada");
                    } else {
                        crearEvento();
                    }
                },
                error: function (data) {
                    alert("Error");
                    console.log(data);
                },
            });
        }
    } else {
        alert("Hora inválida.");
    }
}


function crearEvento(){
    var asunto = $('#asunto').val();
    var iniciaHora = $('#inicia').val();
    var terminaHora = $('#termina').val();
    var quien = $('#quien').val();
    var ubicacion = $('#ubicacion').val();
    var allDay = $('#allDay').is(':checked') ? "1" : "0";
    var repeatEvent = $('#repeatEvent').is(':checked') ? "1" : "0";

    var i = moment(dia.split("T")[0] + " " + iniciaHora, "YYYY-MM-DD hh:mm A");
    var t = moment(dia.split("T")[0] + " " + terminaHora, "YYYY-MM-DD hh:mm A");

    if (i.isValid() && t.isValid()) {
        var inicia = i.format("YYYY-MM-DD HH:mm");
        var termina = t.format("YYYY-MM-DD HH:mm");

        alert('I ' + inicia);
        alert('T ' + termina);

        if (i.isBefore(t)) {
            $.ajax({
                type: "POST",
                url: base_url + 'ordenes_trabajo/crearEvento',
                data: {
                    'asunto': asunto,
                    'inicia': inicia,
                    'termina': termina,
                    'quien': quien,
                    'ubicacion': ubicacion,
                    'allDay': allDay,
                    'repeatEvent': repeatEvent
                },
                success: function(result){
                    window.location.reload();
                },
                error: function(data){
                    alert("Error");
                    console.log(data);
                },
            });
        } else {
            alert("Fecha de inicio debe ser menor a la fecha de terminación");
        }
    } else {
        alert("Hora inválida.");
    }
}
