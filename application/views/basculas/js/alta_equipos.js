function load()
{
    subtipo();
}
function subtipo() {
    var tipo=$('#opTipo').val();
    $('#base').hide();

    if (tipo == 'PLATAFORMA' || tipo == 'RAMPA' || tipo == 'CARRITO' || tipo == 'EXTENSION') {
        $('#marca').hide();
        $('#modelo').hide();
        $('#serie').hide(); 
        $('#capacidad').hide();
        $('#comentarios').hide();
        if (tipo == 'PLATAFORMA' || tipo == 'BASCULA') {
        $('#capacidad').show();   
        }
        if (tipo == 'BASCULA') {
        $('#capacidad').show();   
        $('#comentarios').show();  
        }
    }else{
        $('#marca').show();
        $('#modelo').show();
        $('#serie').show();
        if(tipo=='ESCANER'){
            $('#base').show();
        }

    }
    
}