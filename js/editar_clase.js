$(document).ready(function () {
    $("#guardar").click(function () {
        var curso = $("#curso").val();
        var asignatura = $("#asignatura").val();
        var profesor = $("#profesor").val();
        var anio = $("#anio").val();
        var clase = $("#clase").val();

        $.ajax({
            type: "POST",
            url: "modificar_clase.php",
            data: {"curso":curso,
                   "asignatura":asignatura,
                   "profesor":profesor,
                   "anio":anio,
                   "clase":clase
            },
            success: function (data) {
                datos = data.split(";");
                if(datos[1] == 1){
                    $(location).attr('href','asignatura_asignar.php?curso='+curso);
                }
                else{

                }
            }
        });
    });
});