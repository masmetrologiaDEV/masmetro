function buscar(){
    $('#lblCount').text("");
    var URL = base_url + "equipos/catalogo_manto";
    $('#tabla tbody tr').remove();
    
    var parametro = $("input[name=rbBusqueda]:checked").val();
    var texto = $("#txtBusqueda").val();
    var fecha1 = $("#fecha1").val();
    var fecha2 = $("#fecha2").val();
    var tipo = $('#tipo').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { tipo: tipo, texto : texto, parametro : parametro, fecha1 : fecha1, fecha2 : fecha2},
        success: function(result) {
            if(result)
            {
                var tab = $('#tabla tbody')[0];
                var rs = JSON.parse(result);
                $('#lblCount').text(rs.length + (rs.length == 1 ? " Mantenimiento" : " Mantenimientos"));
                $.each(rs, function(i, elem){
                    var ren = tab.insertRow(tab.rows.length);
                    ren.insertCell(0).innerHTML = "<button type='button'class='btn btn-default btn-xs'>"+elem.idME+"</button>";
                    ren.insertCell(1).innerHTML = elem.tipo;
                    ren.insertCell(2).innerHTML = elem.UserA;
                    ren.insertCell(3).innerHTML = elem.UserManto;
                    ren.insertCell(4).innerHTML = "<a href="+base_url+"equipos/hallazgos/"+elem.idME +" target='_blank'><button type='button'class='btn btn-warning btn-xs'>"+elem.fecha+"</button></a>";
                    
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