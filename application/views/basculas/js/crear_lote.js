var TIPO=null;
function load(){
//     agregarLoteTemp();
}

function agregarLoteTemp(){
    
    var URL = base_url + "basculas/agregarLoteTemp";
    var texto= $('#txtBascula').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { texto : texto},
        success: function(result) {
            if(result)
            {
                CargarLoteTemp();
                document.getElementById("txtBascula").value = "";

            }
            else
            {
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });    
}
function CargarLoteTemp(){
    var qty = $('#basculas').val();
    var URL = base_url + "basculas/cargarLoteTemp";
    $('#tblLote tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblLote tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var ren = tab.insertRow(tab.rows.length);
                    //BASCULA=elem.id_bascula;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = "<button type='button' onclick='eliminar_bascula("+elem.id+")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
                

                if (rs.length == qty) {
                   
                     $('#lblBascula').text('Ok');
                     document.getElementById('lblBascula').style.color = "green";
                     document.getElementById('divBasculas').style.display ='none';  // to hide


                }

                else{
                    
                     $('#lblBascula').text('Falta Elementos');
                     document.getElementById('lblBascula').style.color = "red";
                     document.getElementById('divBasculas').style.display ='';  // to hide

                }
            }
            else
            {
                 $('#lblBascula').text('Falta Elementos');
                     document.getElementById('lblBascula').style.color = "red";
                     document.getElementById('divBasculas').style.display ='';
                
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            };
            
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}

function modalAsignarCliente(){
   // alert(CURRENT_QR);
    $('#divBusqueda').show();
    $("#mdlProveedores").modal();
}
var EMPRESA;
function buscarCliente(){
    var URL = base_url + "/basculas/ajax_getCliente";
    $('#tblBuscarProveedores tr').remove();
    var texto = $("#txtBuscarCliente").val();
    texto = texto.trim();
    
    if(texto)
    {
        $.ajax({
            type: "POST",
            url: URL,
            data: { texto: texto },
            success: function(result) {
                if(result)
                {
                    var tab = $('#tblBuscarProveedores tbody')[0];
                    var rs = JSON.parse(result);
                    $.each(rs, function(i, elem){
                        
                        var ren = tab.insertRow(tab.rows.length);
                        var cell_id = ren.insertCell(0);
                        cell_id.style.display = "none";
                        cell_id.innerHTML = elem.id;
                        var cell = ren.insertCell(1);
                        cell.innerHTML = elem.nombre;
                        EMPRESA = elem.nombre;
                        cell.style.width = "70%";
                        ren.insertCell(2).innerHTML = "<button type='button' onclick='asignarCliente(this)' class='btn btn-primary btn-xs' data-empresa=" + elem.nombre + " value=" + elem.id + "><i class='fa fa-plus'></i> Asignar</button>";
                    });
                }
            },
            error: function(data){
                new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
                console.log(data);
            },
        });
    }
}
function asignarCliente(btn){
    var cliente = $(btn).val();
    
    
   var URL = base_url + "basculas/set_cliente";
   //alert(CURRENT_QR);

    $.ajax({
        type: "POST",
        url: URL,
        data: { cliente: cliente },
        success: function(result) {
            if(result)
            {
                var rs = JSON.parse(result);
                $('#divCliente').show();
                    $('#btnClientes').data('id', rs.id);
                    $('#btnClientes').data('NombreCorto', rs.nombre_corto);
                    $('#lblRazonSocialCliente').text(rs.razon_social);
                    $('#lblRFCCliente').text(rs.rfc);
    
                    var dir = rs.calle + ' ' + rs.numero + ' ' + ((rs.numero_interior ? ('Int. ' + rs.numero_interior + ' ') : '') + rs.colonia) + " CP " + rs.cp;
                    dir += '<br>' + rs.ciudad + ', ' + rs.estado;
                    $('#lblDireccionCliente').html(dir);
                    var boton = "<button type='button' onclick='get_contacto("+cliente+")' id='btnClientes' class='btn btn-primary btn-xs pull-right'><i class='fa fa-phone'></i> Seleccionar Contacto</button>";
                    $('#contacto').html(boton);
                    $('#mdlProveedores').modal('hide');  
                    $('#pnlDatos').show();                 
                    $('#divEquipos').show(); 
            }
        },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
}
function cargar_responsable() {


    
}
function get_contacto(id) {   
   var URL = base_url + "basculas/get_contacto";
   //alert(CURRENT_QR);

    $.ajax({
        type: "POST",
        url: URL,
        data: { id: id },
        success: function(result) {
            if(result)
            {
                var tab = $('#tblContactos tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem)
                {
                    var ren = tab.insertRow(tab.rows.length);
                    ren.insertCell().innerHTML = elem.nombre;
                    ren.insertCell().innerHTML = elem.telefono;
                    ren.insertCell().innerHTML = elem.correo;
                    ren.insertCell().innerHTML = "<button type='button' class='btn btn-default btn-xs' onclick='set_contacto("+elem.id+")'><i class='fa fa-check'></i> Seleccionar</button>";
                });

                $('#mdlContactos').modal();
               
            }
        },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
}

function set_contacto(contacto) {
        
   var URL = base_url + "basculas/set_contacto";
   //alert(CURRENT_QR);

     $.ajax({
        type: "POST",
        url: URL,
        data: { contacto: contacto },
        success: function(result) {
            if(result)
            {
                var rs = JSON.parse(result);
               $('#divContacto').show();
                    
                    $('#lblNombreContacto').text(rs.nombre);
                    $('#lblTelefonoContacto').text(rs.telefono);
                    $('#lblCorreoContacto').text(rs.correo);
                    $('#mdlContactos').modal('hide');                 
            }
        },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}
function validacion() {
     var URL = base_url + "basculas/validacion";
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var rs = JSON.parse(result);
                if (!rs.id_cliente) {
                    alert('Seleccione cliente');
                }
                else if (rs.id_contacto==0) {
                    alert('Seleccione Contacto');
                }
                else if (!rs.fecha_entrega ||!rs.fecha_instalacion ||!rs.fecha_capacitacion ||!rs.fecha_soporte ||!rs.fecha_recoleccion) {
                    alert('Guarde las Fechas');
                }else {
                    crear_lote();
                }
                

            }
        },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
}
function crear_lote(){

    var URL = base_url + "basculas/registrar_lote";
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var rs = JSON.parse(result);
                window.location.href = base_url + 'basculas/ver_lote_pdf/'+rs;

            }
        },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });


}
function buscarAutores(){
    var URL = base_url + "basculas/ajax_getbuscarAutores";
    $('#tblAutores tbody tr').remove();
    
    $.ajax({
        type: "POST",
        url: URL,
        data: { },
        success: function(result) {
            if(result)
            {
                var tab = $('#tblAutores tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem)
                {
                    var ren = tab.insertRow(tab.rows.length);
                    ren.insertCell().innerHTML = elem.Nombre;
                    ren.insertCell().innerHTML = elem.Puesto;
                    ren.insertCell().innerHTML = "<button type='button' onclick='seleccionarAutor(this)' value='" + elem.id +"' class='btn btn-default btn-xs'><i class='fa fa-check'></i> Seleccionar</button>";
                });

                $('#mdlRequisitor').modal();
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
      });
}
function seleccionarAutor(btn){
   

    var URL = base_url + "basculas/ajax_getbuscarAutores";
    var id = $(btn).val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { id : id },
        success: function(result) {
            if(result)
            {
                var rs = JSON.parse(result);
                $('#btnRequisitor').data('id', rs.id);
                $('#btnRequisitor').data('nombre', rs.Nombre);
                $('#btnRequisitor').html("<i class='fa fa-user'></i> " + rs.Nombre);
               
    
                $('#mdlRequisitor').modal('hide');
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
}
function GuardarComentarios() {
    var URL = base_url + "basculas/GuardarComentarios";
    var comentarios = $('#txtNotas').val();
    var text = document.getElementById("txtNotas");

    $.ajax({
        type: "POST",
        url: URL,
        data: { comentarios : comentarios },
        success: function(result) {
            if(result)
            {
                var rs = JSON.parse(result);
                 text.value = '';
                $('#lblComentarios').text(rs.comentarios);

            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
}
function GuardarFechas(){
    var URL = base_url + "basculas/GuardarFechas";
       var fecha_entrega = $('#fEntrega').val();
    var fecha_instalacion = $('#fInstalacion').val();
    var fecha_capacitacion = $('#fCapacitacion').val();
    var fecha_soporte = $('#fSoporte').val();
    var fecha_recoleccion = $('#fRecolecion').val();
    

    $.ajax({
        type: "POST",
        url: URL,
        data: { fecha_entrega : fecha_entrega, fecha_instalacion : fecha_instalacion, fecha_capacitacion : fecha_capacitacion, fecha_soporte : fecha_recoleccion, fecha_recoleccion : fecha_recoleccion,},
        success: function(result) {
            if(result)
            {
                alert('Se guardaron las fechas')

            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });

}
function escanearBascula(){
    var qty = $('#basculas').val();
    if (qty === '' || qty === '0') {
        alert("Agregue cantidad antes de escanear");
    }else{
    $('#mdlBasculas').modal();    
    }
    
}
function escanearPlataforma(){
    var qty = $('#plataformas').val();
    if (qty === '' || qty === '0') {
        alert("Agregue cantidad antes de escanear");
    }else{
    $('#mdlPlataformas').modal();    
    }
    
}
function escanearExtensiones(){
    var qty = $('#extensiones').val();
    if (qty === '' || qty === '0') {
        alert("Agregue cantidad antes de escanear");
    }else{
    $('#mdlExtensiones').modal();    
    }
    
}
function escanearCarritos(){
    var qty = $('#carritos').val();
    if (qty === '' || qty === '0') {
        alert("Agregue cantidad antes de escanear");
    }else{
    $('#mdlCarritos').modal();    
    }
    
}
function escanearRampas(){
    var qty = $('#rampas').val();
    if (qty === '' || qty === '0') {
        alert("Agregue cantidad antes de escanear");
    }else{
    $('#mdlRampas').modal();    
    }
    
}
function escanearScanners(){
    var qty = $('#scanners').val();
    if (qty === '' || qty === '0') {
        alert("Agregue cantidad antes de escanear");
    }else{
    $('#mdlScanners').modal();    
    }
    
}
function escanearImpresoras(){
    var qty = $('#impresoras').val();
    if (qty === '' || qty === '0') {
        alert("Agregue cantidad antes de escanear");
    }else{
    $('#mdlImpresoras').modal();    
    }
    
}
function escanearAccesorios(){
    $('#mdlAccesorios').modal();
}

function agregarLotePlataformaTemp(){
    
    var URL = base_url + "basculas/agregarLotePlataformaTemp";
    var texto= $('#txtPlataforma').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { texto : texto},
        success: function(result) {
            if(result)
            {
                CargarLotePlataformaTemp();
                document.getElementById("txtPlataforma").value = "";

            }
            else
            {
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });    
}
function CargarLotePlataformaTemp(){
    
    var qty = $('#plataformas').val();
    var URL = base_url + "basculas/cargarLotePlataformaTemp";
    $('#tblPlataforma tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblPlataforma tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    TIPO=elem.tipo;
                    var ren = tab.insertRow(tab.rows.length);
                    //BASCULA=elem.id_bascula;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = "<button type='button' onclick='eliminar_accesorio("+elem.id+")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
                if (rs.length == qty) {
                     $('#lblPlataformas').text('Ok');
                     document.getElementById('lblPlataformas').style.color = "green";
                     document.getElementById('divPlataformas').style.display ='none';  // to hide


                }else{
                     $('#lblPlataformas').text('Falta Elementos');
                     document.getElementById('lblPlataformas').style.color = "red";

                }
            }
            else
            {
                $('#lblPlataformas').text('Falta Elementos');
                document.getElementById('lblPlataformas').style.color = "red";
                document.getElementById('divPlataformas').style.display ='';  // to hide
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}




//--------------------------
function agregarLoteExtensionesTemp(){
    
    var URL = base_url + "basculas/agregarLoteExtensionesTemp";
    var texto= $('#txtExtensiones').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { texto : texto},
        success: function(result) {
            if(result)
            {
                CargarLoteExtensionesTemp();
                document.getElementById("txtExtensiones").value = "";

            }
            else
            {
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });    
}
function CargarLoteExtensionesTemp(){
    var qty = $('#extensiones').val();
    var URL = base_url + "basculas/cargarLoteExtensionesTemp";
    $('#tblLoteExtensiones tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {

                var tab = $('#tblLoteExtensiones tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var ren = tab.insertRow(tab.rows.length);
                    TIPO=elem.tipo;
                    //BASCULA=elem.id_bascula;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = "<button type='button' onclick='eliminar_accesorio("+elem.id+")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
                if (rs.length == qty) {
                     $('#lblExtensiones').text('Ok');
                     document.getElementById('lblExtensiones').style.color = "green";
                     document.getElementById('divExtensiones').style.display ='none';  // to hide



                }else{
                     $('#lblExtensiones').text('Falta Elementos');
                     document.getElementById('lblExtensiones').style.color = "red";

                }
            }
            else
            {
                $('#lblExtensiones').text('Falta Elementos');
                document.getElementById('lblExtensiones').style.color = "red";    
                document.getElementById('divExtensiones').style.display ='';  // to hide            
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}

//-----
//--------------------------
function agregarLoteCarritosTemp(){
    
    var URL = base_url + "basculas/agregarLoteCarritosTemp";
    var texto= $('#txtCarritos').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { texto : texto},
        success: function(result) {
            if(result)
            {
                CargarLoteCarritosTemp();
                document.getElementById("txtCarritos").value = "";

            }
            else
            {
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });    
}
function CargarLoteCarritosTemp(){
    var qty = $('#carritos').val();
    var URL = base_url + "basculas/cargarLoteCarritosTemp";
    $('#tblLoteCarritos tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblLoteCarritos tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    TIPO=elem.tipo;
                    var ren = tab.insertRow(tab.rows.length);
                    //BASCULA=elem.id_bascula;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = "<button type='button' onclick='eliminar_accesorio("+elem.id+")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
                if (rs.length == qty) {
                     $('#lblCarritos').text('Ok');
                     document.getElementById('lblCarritos').style.color = "green";
                     document.getElementById('divCarritos').style.display ='none';  // to hide


                }else{
                     $('#lblCarritos').text('Falta Elementos');
                     document.getElementById('lblCarritos').style.color = "red";

                }
            }
            else
            {
                $('#lblCarritos').text('Falta Elementos');
                document.getElementById('lblCarritos').style.color = "red";
                document.getElementById('divCarritos').style.display ='';  // to hide

                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}

//--------------------------
function agregarLoteRampasTemp(){
    
    var URL = base_url + "basculas/agregarLoteRampasTemp";
    var texto= $('#txtRampas').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { texto : texto},
        success: function(result) {
            if(result)
            {
                CargarLoteRampasTemp();
                document.getElementById("txtRampas").value = "";

            }
            else
            {
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });    
}
function CargarLoteRampasTemp(){
    var qty = $('#rampas').val();
    var URL = base_url + "basculas/cargarLoteRampasTemp";
    $('#tblLoteRampas tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblLoteRampas tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    TIPO=elem.tipo;
                    var ren = tab.insertRow(tab.rows.length);
                    //BASCULA=elem.id_bascula;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = "<button type='button' onclick='eliminar_accesorio("+elem.id+")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
                if (rs.length == qty) {
                     $('#lblRampas').text('Ok');
                     document.getElementById('lblRampas').style.color = "green";
                     document.getElementById('divRampas').style.display ='none';  // to hide


                }else{
                     $('#lblRampas').text('Falta Elementos');
                     document.getElementById('lblRampas').style.color = "red";

                }
            }
            else
            {
                $('#lblRampas').text('Falta Elementos');
                document.getElementById('lblRampas').style.color = "red";
                document.getElementById('divRampas').style.display ='';  // to hide

                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}


//--------------------------
function agregarLoteScannersTemp(){
    
    var URL = base_url + "basculas/agregarLoteScannersTemp";
    var texto= $('#txtScanners').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { texto : texto},
        success: function(result) {
            if(result)
            {
                CargarLoteScannersTemp();
                document.getElementById("txtScanners").value = "";

            }
            else
            {
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });    
}
function CargarLoteScannersTemp(){
    var qty = $('#scanners').val();
    var URL = base_url + "basculas/cargarLoteScannersTemp";
    $('#tblLoteScanners tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblLoteScanners tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    TIPO=elem.tipo;
                    var ren = tab.insertRow(tab.rows.length);
                    //BASCULA=elem.id_bascula;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.base;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = "<button type='button' onclick='eliminar_accesorio("+elem.id+")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
                if (rs.length == qty) {
                     $('#lblScanners').text('Ok');
                     document.getElementById('lblScanners').style.color = "green";
                     document.getElementById('divScanners').style.display ='none';  // to hide


                }else{
                     $('#lblScanners').text('Falta Elementos');
                     document.getElementById('lblScanners').style.color = "red";

                }
            }
            else
            {
                $('#lblScanners').text('Falta Elementos');
                document.getElementById('lblScanners').style.color = "red";
                document.getElementById('divScanners').style.display ='';  // to hide

                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}

//--------------------------
function agregarLoteImpresorasTemp(){
    
    var URL = base_url + "basculas/agregarLoteImpresorasTemp";
    var texto= $('#txtExtImpresoras').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { texto : texto},
        success: function(result) {
            if(result)
            {
                CargarLoteImpresorasTemp();
                document.getElementById("txtImpresoras").value = "";

            }
            else
            {
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });    
}
function CargarLoteImpresorasTemp(){
    var qty = $('#impresoras').val();
    var URL = base_url + "basculas/cargarLoteImpresorasTemp";
    $('#tblLoteImpresoras tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblLoteImpresoras tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    TIPO=elem.tipo;
                    var ren = tab.insertRow(tab.rows.length);
                    //BASCULA=elem.id_bascula;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = "<button type='button' onclick='eliminar_accesorio("+elem.id+")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
                if (rs.length == qty) {
                     $('#lblImpresoras').text('Ok');
                     document.getElementById('lblImpresoras').style.color = "green";
                     document.getElementById('divImpresoras').style.display ='none';  // to hide

                }else{
                     $('#lblImpresoras').text('Falta Elementos');
                     document.getElementById('lblImpresoras').style.color = "red";

                }
            }
            else
            {
                $('#lblImpresoras').text('Falta Elementos');
                document.getElementById('lblImpresoras').style.color = "red";
                document.getElementById('divImpresoras').style.display ='';  // to hide

                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}
function eliminar_bascula(id) {

    var URL = base_url + "basculas/eliminar_bascula";
    var texto= $('#txtBascula').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { id : id},
        success: function(result) {
            if(result)
            {
               CargarLoteTemp();
               //document.getElementById("txtBascula").value = "";

            }
            else
            {
                CargarLoteTemp();
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }

          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    }); 

}
function eliminar_accesorio(id) {


    var URL = base_url + "basculas/eliminar_accesorio";
    var texto= $('#txtBascula').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { id : id},
        success: function(result) {
            if(result)
            {
                if (TIPO=='PLATAFORMA') {
                    CargarLotePlataformaTemp();
                }else if (TIPO=='RAMPA') {
                    CargarLoteRampasTemp();
                }
                else if (TIPO=='EXTENSION') {
                    CargarLoteExtensionesTemp();
                }
                else if (TIPO=='CARRITO') {
                    CargarLoteCarritosTemp()
                }
                else if (TIPO=='ESCANER') {
                    CargarLoteScannersTemp();
                }
                else if (TIPO=='IMPRESORA') {
                    CargarLoteImpresorasTemp();
                }
               

            }
            else
            {
                if (TIPO=='PLATAFORMA') {
                    CargarLotePlataformaTemp();
                }else if (TIPO=='RAMPA') {
                    CargarLoteRampasTemp();
                }
                else if (TIPO=='EXTENSION') {
                    CargarLoteExtensionesTemp();
                }
                else if (TIPO=='CARRITO') {
                    CargarLoteCarritosTemp()
                }
                else if (TIPO=='ESCANER') {
                    CargarLoteScannersTemp();
                }
                else if (TIPO=='IMPRESORA') {
                    CargarLoteImpresorasTemp();
                }
               
                new PNotify({ title: '¡Nada por aquí!', text: 'No se encontraron resultados', type: 'info', styling: 'bootstrap3' });
            }

          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    }); 

}