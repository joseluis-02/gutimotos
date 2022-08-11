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
    clave = $("#clave").val();
    idusuario = $("#idusuario").val();
    claver = $("#password2").val();
    if (clave == claver) {
        $.ajax({
            url: "../controller/usuario.php?op=9",
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
                        text: 'Actualización denegada, contacte con el administrador.'
                    });
                } else {
                    swal.fire({
                        type: 'success',
                        title: 'Mensaje de Confirmación',
                        text: 'Contraseña actualizada.'
                    }).then(function() {
                        location.href = "http://localhost:7882/gutystore/";
                    });

                }
            }
        });
    } else {}
}
init();