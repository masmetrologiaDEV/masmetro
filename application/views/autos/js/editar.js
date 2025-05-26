
function uploadFoto() {
  const files = document.getElementById("imgAuto").files;
  const file = files[0];
  const URL = base_url + 'autos/uploadFoto';
  const formdata = new FormData();
  formdata.append("file", file);
  formdata.append("id", AUTO);

  const ajax = new XMLHttpRequest();
  ajax.open("POST", URL);
  ajax.send(formdata);
  ajax.onload = function () {
    window.location.reload();
  };
}



function uploadPoliza() {
  const files = document.getElementById("poliza").files;
  const file = files[0];
  const URL = base_url + 'autos/uploadPoliza';
  const formdata = new FormData();
  formdata.append("file", file);
  formdata.append("id", AUTO);

  const ajax = new XMLHttpRequest();
  ajax.open("POST", URL);
  ajax.send(formdata);
  ajax.onload = function () {
    window.location.reload();
  };
}
