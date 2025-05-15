
function load(){
 
    buscar();
    CargarLoteTemp();
    CargarLoteTempAccesorios();
}
BASCULA=null;
function buscar(){
    
    var URL = base_url + "basculas/get_accesorios";
    $('#tabla tbody tr').remove();
    
    var texto = $("#txtBusqueda").val();
    var parametro = $("input[name=rbBusqueda]:checked").val();
    var tipo = $("#opTipo").val();
    var activo = $("#cbActivo").is(":checked") ? 1 : 0;

    $.ajax({
        type: "POST",
        url: URL,
        data: { parametro : parametro, texto : texto, tipo : tipo, activo : activo },
        success: function(result) {
            
            if(result)
            {
                var tab = $('#tabla tbody')[0];
                var rs = JSON.parse(result);

                $.each(rs, function(i, elem){

                    var ren = tab.insertRow(tab.rows.length);
                    ren.dataset.id = elem.id;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.tipo;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = elem.capacidad;
                    ren.insertCell().innerHTML = elem.estatus;    
                    ren.insertCell().innerHTML ='<button type="button" onclick="editar('+elem.id+')" class="btn btn-warning btn-xs" value="'+elem.id+'"><i class="fa fa-pencil"></i> Editar </button><button type="button" onclick="bitacoraEstatus('+elem.id+')" class="btn btn-success btn-xs" value="'+elem.id+'"><i class="fa fa-pencil"></i> Bitacora </button>';    
                    
                });
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
function agregarLoteTemp(it){
    
    var URL = base_url + "basculas/agregarLoteTemp";
    item=it;
    $.ajax({
        type: "POST",
        url: URL,
        data: { item : item},
        success: function(result) {
            if(result)
            {
               CargarLoteTemp();
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
    
    var URL = base_url + "basculas/cargarLoteTemp";
    $('#tblLote tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            if(result)
            {
                var tab = $('#tblLote tbody')[0];
                var r = JSON.parse(result);
                $.each(r, function(i, elem){
                    var ren = tab.insertRow(tab.rows.length);
                    //BASCULA=elem.id_bascula;
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.no_serie;
                    ren.insertCell().innerHTML = elem.modelo;
                    ren.insertCell().innerHTML = "<button type='button' onclick='mdlAccesorios("+elem.id_bascula+")' class='btn btn-primary btn-xs'><i class='fa fa-plus'></i> Agregar Accesorios</button><button type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
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

function mdlAccesorios(btn){
    $('#tblLoteAccesorios tbody tr').remove();
    $('#tblAccesorios tbody tr').remove();
    CargarLoteTempAccesorios(btn);
    CargarLoteTemp();
     
      

      $.ajax({
          type: "POST",
          url: base_url + 'basculas/ajax_getAccesorios',
          data: {  },
          success: function(result)
          {
              var tbl = $('#tblAccesorios tbody')[0];
              var rs = JSON.parse(result);
              $.each(rs, function(i, elem){
                  var row = tbl.insertRow();

                  row.insertCell().innerHTML = elem.tipo;
                  row.insertCell().innerHTML = elem.no_inventario;
                  row.insertCell().innerHTML = elem.modelo;
                  row.insertCell().innerHTML = elem.estatus;
                  row.insertCell().innerHTML="<button type='button' onclick='agregarLoteAccesoriosTemp("+elem.id+","+btn+");' class='btn btn-warning btn-xs'><i class='fa fa-plus'></i> Agregar</button>";
                  

              }); 
          },
          error: function(data){
              console.log(data);
          },
      });

      $('#mdlAccesorios').modal();
      
    }
    function agregarLoteAccesoriosTemp(id_accesorio, id_bascula){
       // alert(BASCULA);
    
    var URL = base_url + "basculas/agregarLoteAccesoriosTemp";
    id_bascula=id_bascula;
    id_accesorio=id_accesorio;
    $.ajax({
        type: "POST",
        url: URL,
        data: { id_accesorio : id_accesorio, id_bascula : id_bascula},
        success: function(result) {
            if(result)
            {
                CargarLoteTemp();
               CargarLoteTempAccesorios(id_bascula);
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
function CargarLoteTempAccesorios(id_bascula){
    
    var URL = base_url + "basculas/CargarLoteAccesoriosTemp";
    $('#tblLoteAccesorios tbody tr').remove();
    $.ajax({
        type: "POST",
        url: URL,
        data: { id_bascula : id_bascula},
        success: function(result) {
            if(result)
            {
                var tab = $('#tblLoteAccesorios tbody')[0];
                var r = JSON.parse(result);
                $.each(r, function(i, elem){
                    var ren = tab.insertRow(tab.rows.length);
                   
                    ren.insertCell().innerHTML = elem.no_inventario;
                    ren.insertCell().innerHTML = elem.tipo;
                    ren.insertCell().innerHTML = elem.no_inventarioAccesorio ;
                    ren.insertCell().innerHTML = "<button type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Eliminar</button>";
                });
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
function editar(id_accesorio){
    //alert(id_bascula);
 var URL = base_url + "basculas/get_accesorio";
   
    $.ajax({
        type: "POST",
        url: URL,
        data: { id_accesorio : id_accesorio},
        success: function(result) {
            if(result)
            {
               // var tab = $('#tblLoteAccesorios tbody')[0];
                var r = JSON.parse(result);
                //alert(r);
                document.getElementById("id_equipo").value = r.id;
                document.getElementById("id").value = r.no_inventario;
                document.getElementById("marca").value = r.marca;
                document.getElementById("modelo").value = r.modelo;
                document.getElementById("serie").value = r.no_serie;
                if (r.activo ==1) {
                document.getElementById("activo").checked = true;

                }else{
                document.getElementById("activo").checked = false;

                }
                if (r.tipo=="ESCANER") {
                    cargar_base(r.id);
                    $('#base').show();
                    

                }else{
                    $('#base').hide();

                }

                
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
 $('#mdlEquipos').modal();

}
function cargar_base(escaner) {
     var URL = base_url + "basculas/get_base";
   
    $.ajax({
        type: "POST",
        url: URL,
        data: { escaner : escaner},
        success: function(result) {
            if(result)
            {
               // var tab = $('#tblLoteAccesorios tbody')[0];
                var r = JSON.parse(result);
                alert(r.no_inventario);
                document.getElementById("idbase").value = r.id;
                document.getElementById("id_base").value = r.no_inventario;
                document.getElementById("marca_base").value = r.marca;
                document.getElementById("modelo_base").value = r.modelo;
                document.getElementById("serie_base").value = r.no_serie;
               

                
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
function bitacoraEstatus(id){
    
    $('#tblBitacora tbody tr').remove();
    var URL = base_url + "basculas/ajax_getBitacoraAccesorios";
    var dic = {}
    //alert(CURRENT_PR);
    $.ajax({
        type: "POST",
        url: URL,
        data: { id : id },
        success: function (response) {
            if(response){
                var rs = JSON.parse(response);
                var tbl = $('#tblBitacora tbody')[0];
                $.each(rs, function(i, elem){
                    var ren = tbl.insertRow(tbl.rows.length);
                    
                    ren.insertCell(0).innerHTML = elem.estatus;
                    ren.insertCell(1).innerHTML = elem.fecha;
                    ren.insertCell(2).innerHTML = elem.name;
                    ren.insertCell(3).innerHTML = elem.comentarios;
                    
                    
                });

                $('#mdlBitacora').modal();
            }
        }
    });   
}