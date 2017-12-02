$(document).ready(function () {
    $("#guardar").click(function () {
        var nombre = $("#asig").val();
        var id = $("#id_as").val();

        $.ajax({
            type: "POST",
            url: "asignatura_editar.php",
            data: {
                "nombre": nombre,
                "id":id
            },
            success: function (data) {
                datos = data.split(";");
                if (datos[1] == 1) {
                    alert("Se edito la asignatura");
                    window.location.href = "asignatura_crear.php";
                }
                else {
                    alert("No se pudo editar la asignatura");
                }
            }
        });
    });
});