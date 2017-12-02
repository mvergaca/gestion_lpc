$(document).ready(function () {
    $("#buscar").click(function () {
        var rut = $("#rut").val();

        $.ajax({
            type: "POST",
            url: "buscar_usuario.php",
            data: {"rut":rut},
            success: function (data) {
                datos = data.split("|");
                if(datos[1] == 1){

                    $("#resultado").html(datos[2]);

                    $("#ver").click(function () {
                        var rut =$("#id_usr").val();
                        window.location.href = "usuario_ver.php?rut="+rut;
                    });

                    $("#editar").click(function () {
                        var rut =$("#id_usr").val();
                        window.location.href = "usuario_modificar.php?rut="+rut;
                    });

                    $("#eliminar").click(function () {
                        var rut =$("#id_usr").val();
                        $.ajax({
                            type: "POST",
                            url: "usuario_eliminar.php",
                            data: {"rut":rut},
                            success: function (data) {
                                datos = data.split(";");
                                if(datos[1] == 1){
                                    $("#resultado").html("no se ha encontrado informacion asociada a ese rut");
                                }
                                else{
                                    alert("No se pudo eliminar el usuario");
                                }
                            }
                        });
                    });

                }
                else{
                    $("#resultado").html("no se ha encontrado informacion asociada a ese rut");
                }
            }
        });
    });
    $("#rut").click(function () {
        alert("SI");
    });

});


