function load(){
 
    buscar();
}

function buscar(){
    
    var URL = base_url + "basculas/get_lotes";
    $('#tabla tbody tr').remove();
    
    /*var texto = $("#txtBusqueda").val();
    var parametro = $("input[name=rbBusqueda]:checked").val();*/

    $.ajax({
        type: "POST",
        url: URL,
      //  data: { parametro : parametro, texto : texto },
        success: function(result) {
            
            if(result)
            {
                var tab = $('#tabla tbody')[0];
                var rs = JSON.parse(result);

                $.each(rs, function(i, elem){

                    var ren = tab.insertRow(tab.rows.length);
                    ren.dataset.id = elem.id;
                    ren.insertCell().innerHTML = elem.id;
                    ren.insertCell().innerHTML = elem.fecha_creacion;
                    ren.insertCell().innerHTML = elem.fecha_entrega;
                    ren.insertCell().innerHTML = elem.nombre;        
                    ren.insertCell().innerHTML = "<a target='_blank' href='" + base_url + "basculas/ver_lote_pdf/"+ elem.id +"'><button class='btn btn-warning btn-xs'><i class='fa fa-file-pdf-o'></i> Ver PDF</a>";
                    
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