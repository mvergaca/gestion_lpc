$(document).ready(function () {
    $("#guardar").click(function () {
        var nombre = $("#nombre").val();
        var id = $("#id_as").val();
        var encargado = $("#encargado").val();

        if(encargado == ""){
            encargado == null;
        }

        $.ajax({
            type: "POST",
            url: "sala_editar.php",
            data: {
                "nombre": nombre,
                "id":id,
                "encargado":encargado
            },
            success: function (data) {
                datos = data.split(";");
                if (datos[1] == 1) {
                    alert("Se edito la sala");
                    window.location.href = "sala_crear.php";
                }
                else {
                    alert("No se pudo editar la sala");
                }
            }
        });
    });
});