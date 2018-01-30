$(document).ready(function () {
    $("#guardar").click(function () {
        var alumno = $("#alumno").val();
        var apoderado = $("#apoderado").val();
        var motivo = $("#motivo").val();

        if(alumno != "" && apoderado != "" && motivo != "") {
            $.ajax({
                type: "POST",
                url: "guardar_retiro.php",
                data: {
                    "alumno": alumno,
                    "apoderado": apoderado,
                    "motivo":motivo
                },
                success: function (data) {
                    datos = data.split(";");
                    if (datos[1] == 1) {
                        window.location.href = "ver_retiros.php";
                    }
                    else {
                        alert("No se pudo guardar el retiro");
                    }
                }
            });
        }
        else{
            alert("Todos los campos son obligatorios");
        }
    });
});

function cargar_alumnos() {
    var curso = $("#curso").val();

    $.ajax({
        type: "POST",
        url: "cargar_curso.php",
        data: {
            "curso": curso
        },
        success: function (data) {
            datos = data.split(";");
            if (datos[1] == 1) {
                $("#alumno").html(datos[2]);
            }
            else {
                alert("No se encontraron alumnos en este curso");
            }
        }
    });
}

function cargar_apoderado() {
    var alumno = $("#alumno").val();

    $.ajax({
        type: "POST",
        url: "cargar_apoderado.php",
        data: {
            "alumno": alumno
        },
        success: function (data) {
            datos = data.split(";");
            if (datos[1] == 1) {
                $("#apoderado").html(datos[2]);
            }
            else {
                alert("No se encontraron apoderados vinculados al alumno");
            }
        }
    });
}