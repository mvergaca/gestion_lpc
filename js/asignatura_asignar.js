$(document).ready(function () {
    $("#guardar").click(function () {
        var curso = $("#curso").val();
        var asignatura = $("#asignatura").val();
        var profesor = $("#profesor").val();
        var anio = $("#anio").val();

        if(curso == "" || asignatura == "" || profesor == "" || anio == ""){
            alert("Todos los campos son obligatorios");
        }
        else{
            $.ajax({
                type: "POST",
                url: "asignar_asignatura.php",
                data: {
                    "curso": curso,
                    "asignatura":asignatura,
                    "profesor":profesor,
                    "anio": anio
                },
                success: function (data) {
                    datos = data.split("|");
                    if (datos[1] == 1) {
                        $("#asignadas").html(datos[2]);
                    }
                    else {
                        alert(datos[2]);
                    }
                }
            });

        }

    });
});

function editar_clase(ref) {

    var curso = $("#curso").val();
    window.location.href = "editar_clase.php?curso="+curso+"&id="+ref;
}

function eliminar_clase(ref, ind) {
    $.ajax({
        type: "POST",
        url: "eliminar_clase.php",
        data: {
            "ref": ref
        },
        success: function (data) {
            datos = data.split(";");
            if (datos[1] == 1) {
                $("#fila_"+ind).remove();
            }
            else {
                alert("No se pudo eliminar la clase");
            }
        }
    });
    $("#fila_"+ind).remove();
}