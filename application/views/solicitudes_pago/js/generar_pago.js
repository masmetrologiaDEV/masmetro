var LISTA_PoS = [];
var CURRENT_PROV = 0;
var CURRENT_PROV_NOM = 0;
var CURRENT_MONEDA;
var CURRENT_TIPO;

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
    var URL = base_url + "solicitudes_pago/ajax_getPoPagos";
    $('#tabla tbody tr').remove();
    
    var parametro = $("input[name=rbBusqueda]:checked").val();
    var texto = $("#txtBusqueda").val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { texto : texto, parametro : parametro, id_proveedor : CURRENT_PROV, moneda : CURRENT_MONEDA, tipo : CURRENT_TIPO },
        success: function(result) {
            if(result)
            {
                var tab = $('#tabla tbody')[0];
                var rs = JSON.parse(result);
                $.each(rs, function(i, elem){
                    var ren = tab.insertRow(tab.rows.length);
                    $('#lblCount').text(rs.length + (rs.length == 1 ? " PO" : " PO's"));
                    
                    var check = LISTA_PoS.includes(elem.id) ? 'checked' : '';
                    ren.insertCell().innerHTML = "<input data-id='" + elem.id + "' data-idprov='" + elem.IdProv + "' data-nomprov='" + elem.Prov + "' data-moneda='" + elem.moneda + "' data-tipo='" + elem.tipo + "' type='checkbox' class='flat selecc' name='rbBusqueda' value='proveedor' "+ check +"/>";
                    ren.insertCell().innerHTML = "<button type='button' onclick='getPO(this)' value='" + elem.id +"' class='btn btn-default btn-xs'>" + elem.id + "</button>";
                    ren.insertCell().innerHTML = elem.Prov;
                    ren.insertCell().innerHTML = elem.tipo;
                    ren.insertCell().innerHTML = elem.total;
                    
                    var btn = "";
                    switch (elem.estatus_pago)
                    {
                        case 'APROBADO':
                        btn = 'btn btn-success btn-xs';
                        break;

                        case 'PENDIENTE':
                        case 'EN SELECCION':
                        btn = 'btn btn-warning btn-xs';
                        break;

                        case 'RECHAZADO':
                        btn = 'btn btn-danger btn-xs';
                        break;

                        case 'PROCESADO':
                        case 'CANCELADO':
                        btn = 'btn btn-default btn-xs';
                        break;
                    }
                    var cell7 = ren.insertCell(5);
                    cell7.innerHTML = "<a href='#' class='" + btn + "'>" + elem.estatus_pago + "</a>";

                    $('input.flat').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });

                    $('input.selecc').on('ifChanged', function(){
                        seleccionar(this);
                    });
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

function getPO(btn){
    var URL = base_url + 'ordenes_compra/ajax_getPO';
    var idPR = $(btn).val();

    $.ajax({
        type: "POST",
        url: URL,
        data: { id: idPR },
        success: function(result) {
            if(result)
            {
                $('#tblDetalle tr').remove();
                var tab = $('#tblDetalle tbody')[0];

                var rs = JSON.parse(result);
                
                
                $(".mdlTitulo").text("PO # " + rs.id);
               
                $("#lblRequisitor").html('Requisitor: <small>' + rs.UserA + '</small>');
                $("#lblEstatus").html('Estatus: <small>' + rs.estatus + '</small>');
                $("#lblAprobador").html('Aprobador: <small>' + rs.UserA + '</small>');
               // $("#lblRequisitor").text(rs.UserA);
               
            }
          },
        error: function(data){
            new PNotify({ title: 'ERROR', text: 'Error', type: 'error', styling: 'bootstrap3' });
            console.log(data);
        },
      });
      $("#mdlDetalle").modal();
}

function seleccionar(cb){
    var id = cb.dataset.id;
    var idprov = cb.dataset.idprov;
    var nombre = cb.dataset.nomprov;
    var moneda = cb.dataset.moneda;
    var tipo = cb.dataset.tipo;

    if($(cb).is(':checked'))
    {
        LISTA_PoS.push(id);
    }
    else
    {
        var index = LISTA_PoS.indexOf(id);
        LISTA_PoS.splice(index, 1);
    }

    if(LISTA_PoS.length == 0)
    {
        $('#divProveedor').hide();
        $('#lblNombreProveedor').text("");
        CURRENT_PROV = 0;
        CURRENT_PROV_NOM = '';

    }
    else
    {
        $('#divProveedor').show();
        $('#lblNombreProveedor').text(nombre);
        CURRENT_PROV = idprov;
        CURRENT_MONEDA = moneda;
        CURRENT_TIPO = tipo;
        CURRENT_PROV_NOM = nombre;
    }

    console.log(LISTA_PoS);

    buscar();
}

function continuar(){

    var URL = base_url + 'solicitudes_pago/ajax_setTempPago';
    $.ajax({
        type: "POST",
        url: URL,
        data: { pos: JSON.stringify(LISTA_PoS)},
        success: function(result) {
            if(result)
            {
                alert(result);
            window.location.href = base_url + 'solicitudes_pago/construccion_pago/' + result;           
             }
        }
    });



    /*var URL = base_url + 'ordenes_compra/construccion_po';
    var f = document.createElement("form");
    f.setAttribute('method',"post");
    f.setAttribute('action', URL);

    var un = document.createElement("input");
    un.setAttribute('type',"hidden");
    un.setAttribute('name',"unid");
    un.setAttribute('value', UNID);
    f.appendChild(pn);

    var p = document.createElement("input");
    p.setAttribute('type',"hidden");
    p.setAttribute('name',"id_prov");
    p.setAttribute('value', CURRENT_PROV);
    f.appendChild(p);
    
    var pn = document.createElement("input");
    pn.setAttribute('type',"hidden");
    pn.setAttribute('name',"nombre_prov");
    pn.setAttribute('value', CURRENT_PROV_NOM);
    f.appendChild(pn);

    $.each(LISTA_PRS, function(i, elem){
        var i = document.createElement("input");
        i.setAttribute('type',"hidden");
        i.setAttribute('name',"prs[]");
        i.setAttribute('value', elem);
        f.appendChild(i);
    });

    $(document.body).append(f);
    f.submit();
    */
}
