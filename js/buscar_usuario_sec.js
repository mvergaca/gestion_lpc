$(document).ready(function () {
    $("#buscar").click(function () {
        var rut = $("#rut").val();

        $.ajax({
            type: "POST",
            url: "usuario_buscar_utp.php",
            data: {"rut":rut},
            success: function (data) {
                datos = data.split("|");
                if(datos[1] == 1){

                    $("#resultado").html(datos[2]);

                    $("#ver").click(function () {
                        var rut =$("#id_usr").val();
                        window.location.href = "usuario_ver_sec.php?rut="+rut;
                    });

                }
                else{
                    $("#resultado").html("<label class='label-danger'>No se ha encontrado informacion asociada a ese rut</label>");
                }
            }
        });
    });

});