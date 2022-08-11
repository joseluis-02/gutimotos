//Función que se ejecuta al inicio
function init() {
    $("#frmRestablecer").on("submit", function(e) {
        ver(e);
    })
}
//Función verificar correo
function ver(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var formData = new FormData($("#frmRestablecer")[0]);
    $.ajax({
        url: "../controller/usuario.php?op=8",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            if (datos == 0) {
                swal.fire({
                    type: 'error',
                    title: 'respuesta',
                    text: 'No existe una cuenta asociada a ese correo.'
                });
            } else {
                swal.fire(
                    'Mensaje de Confirmación',
                    'Mensaje Enviado, por favor, verifique su cuenta de Correo Electrónico',
                    'success',

                );
                $("#email").val("");
            }
        }
    });
}
init();