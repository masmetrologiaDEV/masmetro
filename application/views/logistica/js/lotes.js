function load(){
    buscar();
}

function buscar(){
    
    var URL = base_url + "logistica/getLotes";
    $('#tablaLotes tbody tr').remove();
    var r;
    $.ajax({
        type: "POST",
        url: URL,
        success: function(result) {
            alert(JSON.stringify(result));
            
            
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
    });
    
}

