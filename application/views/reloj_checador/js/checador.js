var camara = false;
var usuario = USUARIO;
var idusuario = IDUSUARIO;
var sayCheese;
var dias = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

$("#no_empleado").on('keyup', function (e) {
    if (e.keyCode === 13) {
        registrarEntrada();
    }
});

$(function () {
    var fecha = new Date();
    var year = fecha.getFullYear();
    var month = fecha.getMonth();
    var day = fecha.getDay();
    var date = fecha.getDate();

    $("#fecha").html(dias[day] + ' ' + date + ' de ' + meses[month] + ' ' + year);

    setInterval(function () {
        var hora = new Date();
        $("#reloj").html(moment(hora).format("hh:mm:ss A"));
    }, 1000);

    if (idusuario !== "0") {
        getChecadas(idusuario);
    }
});

function getChecadas(usuario) {
    $.ajax({
        type: "POST",
        url: BASE_URL + 'reloj_checador/checadas_ajax',
        data: { 'idusuario': idusuario },
        success: function (result) {
            if (result) {
                var res = JSON.parse(result);
                var tab = $('#tabla')[0];
                $.each(res, function (i, elem) {
                    var ren = tab.insertRow(tab.rows.length);
                    ren.insertCell(0).innerHTML = tab.rows.length - 1;
                    ren.insertCell(1).innerHTML = '<img src="' + elem.foto + '" width="100" class="usuario"/>';
                    ren.insertCell(2).innerHTML = elem.User;
                    ren.insertCell(3).innerHTML = elem.tipo;
                    ren.insertCell(4).innerHTML = moment(elem.hora).format('MM/DD/YYYY hh:mm A');
                });
            }
        },
    });
}

$(function () {
    sayCheese = new SayCheese('#camera', { width: 500 });

    sayCheese.on('start', function () {
        $('video').css('width', '95%');
        camara = true;
        if (usuario !== "0") {
            alert('Se tomará su registro de ENTRADA');
            $('#no_empleado').val(usuario);
            registrarEntrada();
        }
    });

    sayCheese.on('error', function () {
        camara = false;
        if (usuario !== "0") {
            alert('Se tomará su registro de ENTRADA');
            $('#no_empleado').val(usuario);
            registrarEntrada();
        }
    });

    sayCheese.on('snapshot', function (snapshot) {
        FOTO = document.createElement('img');
        FOTO.src = snapshot.toDataURL('image/png');
    });

    sayCheese.start();
});

var tipoActual;

function registrarEntrada() {
    var no_empleado = $('#no_empleado').val();

    $.ajax({
        type: "POST",
        url: BASE_URL + 'reloj_checador/comprobar_usuario_ajax',
        data: { 'no_empleado': no_empleado },
        success: function (result) {
            if (result) {
                var res = JSON.parse(result);
                $('#nombre').html(res.UserShort);
                $('#id_usuario').val(res.id);
                tipoActual = res.tipo;

                switch (res.tipo) {
                    case "N/A":
                        checar('ENTRADA');
                        break;
                    case "ENTRADA":
                        $('#modal').modal();
                        break;
                    case "DESAYUNO":
                    case "COMIDA":
                        checar('REGRESO ' + res.tipo);
                        break;
                    default:
                        if (res.tipo.startsWith("REGRESO")) {
                            if (res.tipo === "REGRESO DESAYUNO") {
                                $('#modal').modal();
                            } else {
                                checar('SALIDA');
                            }
                        } else if (res.tipo === "SALIDA") {
                            new PNotify({ title: 'Reloj Checado', text: 'JORNADA COMPLETA', type: 'warning', styling: 'bootstrap3' });
                        }
                        break;
                }
            } else {
                new PNotify({ title: 'Usuario', text: 'No Existe Usuario', type: 'error', styling: 'bootstrap3' });
            }
        },
        error: function (data) {
            new PNotify({ title: 'ERROR', text: 'Error al agregar Contacto', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
}

function checar(tipo) {
    $('#tipo').val(tipo);
    $('#forma').fadeOut('slow', function () {
        $('#infoUsuario').fadeIn('slow');
        conteo();
    });
}

function descanso() {
    var hora = new Date().getHours();
    if (tipoActual === 'ENTRADA' && hora < 12) {
        checar('DESAYUNO');
    } else {
        checar('COMIDA');
    }
}

function salida() {
    checar('SALIDA');
}

function conteo() {
    var cuenta = 2;
    $('#conteo').html('foto en... 3');
    var intervalo = setInterval(function () {
        if (cuenta !== 0) {
            $('#conteo').html('foto en... ' + cuenta);
        } else {
            $('#conteo').html('¡Sonrie!');
        }
        cuenta--;
        if (cuenta === -1) {
            clearInterval(intervalo);
            subirFoto();
            $('#infoUsuario').fadeOut('slow', function () {
                $('#no_empleado').val('');
                $('#forma').fadeIn('slow');
            });
        }
    }, 1000);
}

function subirFoto() {
    var width = 320, height = 240;
    var src = "";

    if (camara) {
        sayCheese.takeSnapshot(width, height);
        src = FOTO.src;
    }

    var usuario = $('#id_usuario').val();
    var tipo = $('#tipo').val();

    $.ajax({
        type: "POST",
        url: BASE_URL + 'reloj_checador/checar_ajax',
        data: { 'src': src, 'usuario': usuario, 'tipo': tipo },
        success: function (result) {
            if (result) {
                var res = JSON.parse(result);
                var tab = $('#tabla')[0];
                var ren = tab.insertRow(tab.rows.length);
                ren.insertCell(0).innerHTML = tab.rows.length - 1;
                ren.insertCell(1).innerHTML = '<img src="' + res.foto + '" width="100" class="usuario"/>';
                ren.insertCell(2).innerHTML = $('#nombre').html();
                ren.insertCell(3).innerHTML = res.tipo;
                ren.insertCell(4).innerHTML = moment(res.hora).format('MM/DD/YYYY hh:mm A');
                new PNotify({ title: 'Se ha registrado', text: 'Se ha agregado Contacto con Éxito', type: 'success', styling: 'bootstrap3' });
            } else {
                new PNotify({ title: 'ERROR', text: 'Error al agregar Contacto', type: 'error', styling: 'bootstrap3' });
            }
        },
        error: function (data) {
            new PNotify({ title: 'ERROR', text: 'Error al agregar Contacto', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
}

function inicio() {
    window.location.href = BASE_URL + 'inicio';
}
