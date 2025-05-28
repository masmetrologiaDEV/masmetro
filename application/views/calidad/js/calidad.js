// --- Firma (SignaturePad) ---
var wrapper = document.getElementById("signature-pad");
if (wrapper) {
    var canvas = wrapper.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });

    function resizeCanvas() {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }

    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();
}

// --- Generar base64 al enviar formulario ---
var form = document.getElementById('form');
if (form) {
    form.addEventListener("submit", function (e) {
        var ctx = document.getElementById("canvas");
        var image = ctx.toDataURL(); // data:image/png....
        document.getElementById('base64').value = image;
    }, false);
}

// --- QR Code Scanner ---
function onScanSuccess(qrCodeMessage) {
    document.getElementById('result').innerHTML =
        "<input style='text-transform: uppercase;' id='id_equipo' class='form-control col-md-7 col-xs-12' name='id_equipo' placeholder='' required='required' type='text' value='" + qrCodeMessage + "'>";
}

function onScanError(errorMessage) {
    // puedes hacer un log aquí si quieres
    console.warn("QR Scan error: ", errorMessage);
}

if (document.getElementById("reader")) {
    var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: 250
    });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
}
