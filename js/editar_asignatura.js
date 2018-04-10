$(document).ready(function () {
    $("#guardar").click(function () {
        var nombre = $("#asig").val();
        var id = $("#id_as").val();

        if($("#si").is(":checked")){
            var promediable = 0;
        }else{
            var promediable = 1;
        }

        $.ajax({
            type: "POST",
            url: "asignatura_editar.php",
            data: {
                "nombre": nombre,
                "id":id,
                "promediable":promediable
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