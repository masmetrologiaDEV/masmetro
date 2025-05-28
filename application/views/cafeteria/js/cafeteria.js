var bForm = true;

function confirmar() {
  var valor = true;

  if (bForm) {
    if (
      !$("[name='titulo']").val() ||
      !$("[name='descripcion']").val() ||
      !$("[name='opCategoria']").val()
    ) {
      alert("Ingrese todos los campos");
      valor = false;
    } else {
      if (confirm("¿Desea continuar?")) {
        bForm = false;
        valor = true;
      } else {
        valor = false;
      }
    }
  } else {
    valor = false;
  }

  return valor;
}

function enviarTicket() {
  $('#frmTicket').submit();
}
