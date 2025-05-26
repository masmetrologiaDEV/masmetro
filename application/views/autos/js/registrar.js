function confirmar() {
  const totalIpts = $('input[type=radio]');
  const chkIpts = $('input[type=radio]:checked');

  if (chkIpts.length == (totalIpts.length / 2)) {
    return confirm('¿Desea continuar?');
  } else {
    alert('Capture todos los puntos de revisión');
    return false;
  }
}



function comprobarKM() {
  const kmAnt = kilometrajeActual; // viene desde PHP
  const inpKM = document.getElementById('kilometraje').value;

  if (inpKM < kmAnt && inpKM.length !== 0) {
    alert('Kilometraje no puede ser menor a los ' + parseInt(kmAnt).toLocaleString() + ' KM');
    document.getElementById('kilometraje').value = '';
  }
}



let Maximo = 25; // MAX MB (aunque no se usa)
let alto = 0;
let ancho = 0;
let tamano = 0;
let tamanoMB = 0;
let tam_MG = 0;

function subirFoto(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const img = new Image();
      img.src = e.target.result;
      img.onload = function () {
        ancho = this.width;
        alto = this.height;
      };

      if (tamanoMB <= 3.5) {
        $("#image").attr('src', img.src);
        document.getElementById("txtDesc").value = '';
        document.getElementById("btnUpload").value = '';
        $("#myModal").modal();
      } else {
        alert("Tamaño máximo permitido: 3.5 MB");
      }
    };

    tamano = input.files[0].size;
    tamanoMB = (tamano / 1024) / 1024;
    reader.readAsDataURL(input.files[0]);
  }
}



function aceptar() {
  const texto = document.getElementById("txtDesc").value;

  if (texto.length > 0) {
    tam_MG += tamanoMB;
    document.getElementById("fotoHeader").innerText = "Fotos (" + tam_MG.toFixed(2) + " MB)";
    if (tam_MG > Maximo) {
      document.getElementById("btnUpload").disabled = true;
      document.getElementById("fotoHeader").innerText = "Fotos (MAX " + Maximo + " MB)";
    }

    let datos = $('#image').attr('src');
    datos = datos.substr(datos.search(',') + 1);

    $.ajax({
      type: "POST",
      url: baseUrl + 'autos/temp_photos',
      data: {
        archivo: datos,
        texto: texto,
        auto: autoId,
        iu: iu
      },
      success: function(result) {
        const ob = JSON.parse(result);
        $('#tabla').append(
          '<tr class="even pointer">' +
          '<td width="20%"><img width="100" src="data:image/jpeg;base64,' + ob.file + '"></td>' +
          '<td><input name="texto[]" type="hidden" value="' + texto + '">' + texto + '</td>' +
          '<td><button onclick="eliminar(this)" data-idtemp="' + ob.id + '" value="' + tamano + '" class="btn btn-danger">Eliminar</button></td>' +
          '</tr>'
        );
      },
      error: function(data) {
        alert("Error");
        console.log(data);
      },
    });
  } else {
    alert("Ingrese Descripción");
  }
}



function eliminar(btn) {
  tam_MG -= (btn.value / 1024) / 1024;
  
  if (tam_MG > Maximo) {
    document.getElementById("btnUpload").disabled = true;
    document.getElementById("fotoHeader").innerText = "Fotos (MAX " + Maximo + " MB)";
  } else {
    document.getElementById("btnUpload").disabled = false;
    document.getElementById("fotoHeader").innerText = "Fotos (" + tam_MG.toFixed(2) + " MB)";
  }

  const i = btn.parentNode.parentNode.rowIndex;
  const id_temp = btn.dataset.idtemp;
  alert(id_temp);

  $.ajax({
    type: "POST",
    url: baseUrl + 'autos/delete_temp_photos',
    data: { id: id_temp },
    success: function(result) {
      document.getElementById("tabla").deleteRow(i);
    },
    error: function(data) {
      alert("Error");
      console.log(data);
    }
  });
}

