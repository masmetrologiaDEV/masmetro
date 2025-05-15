function load(){
    eventos();
    buscar();
}

function eventos(){
    
    $( '#txtBusqueda' ).on( 'keypress', function( e ) {
        if( e.keyCode === 13 ) {
            buscar();
        }
    });

    
}

function buscar(){
    $('#lblCount').text("");
    var URL = base_url + "solicitudes_pago/ajax_getSolicitudes";
    $('#tabla tbody tr').remove();
    var id =1;
    var parametro = $("input[name=rbBusqueda]:checked").val();
    var texto = $("#txtBusqueda").val();

    var estatus = $('#opEstatus').val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { estatus: estatus, texto : texto, parametro : parametro, id : id },
        success: function(result) {
            if(result)
            {
                var tab = $('#tabla tbody')[0];
                var rs = JSON.parse(result);
                $('#lblCount').text(rs.length + (rs.length == 1 ? " Solicitud" : " Solictudes"));

                $.each(rs, function(i, elem){
                    var ren = tab.insertRow(tab.rows.length);
                    ren.insertCell(0).innerHTML = "<button type='button' value='" + elem.id +"' class='btn btn-default btn-xs'>" + elem.id + "</button>";
                    ren.insertCell(1).innerHTML = moment(elem.fecha).format('YYYY-MM-DD');
                    ren.insertCell(2).innerHTML = elem.requisitor;
                    ren.insertCell(3).innerHTML = elem.nombre;
                    
                    var btn = ""; 
                    var link = base_url + "solicitudes_pago/ver_pago/"+ elem.id;
                    switch (elem.estatus)
                    {
                        case 'PROGRAMADO':
                        case 'PENDIENTE':
                        btn = 'btn btn-warning btn-xs';
                        break;

                        case 'SOLICITADO':
                        case 'APROBADO':
                        btn = 'btn btn-success btn-xs';
                        break;

                        case 'CANCELADO':
                        btn = 'btn btn-default btn-xs';
                        break;

                        case 'RECHAZADO':
                        btn = 'btn btn-danger btn-xs';
                        break;

                        case 'PAGADO':
                        btn = 'btn btn-primary btn-xs';
                        break;
                    }

                    
                    
                    ren.insertCell(4).innerHTML = "<a target='_blank' href='" + link +"' class='" + btn + "'>" + elem.estatus + "</a>";
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
