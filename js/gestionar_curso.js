function aprobar(ref) {
    var alumno = ref;
    var curso = $("#curso").val();

    if(curso != "") {
        $.ajax({
            type: "POST",
            url: "aprobar.php",
            data: {
                "alumno": alumno,
                "curso":curso
            },
            success: function (data) {
                datos = data.split(";");
                if (datos[1] == 1) {
                    alert("Alumno aprobado");
                }
                else {
                    alert(datos[2]);
                }
            }
        });
    }
    else{
        alert("Seleccione un curso");
    }
}

function reprobar(ref) {
    var alumno = ref;
    var curso = $("#curso").val();

    if(curso != "") {
        $.ajax({
            type: "POST",
            url: "reprobar.php",
            data: {
                "alumno": alumno,
                "curso":curso
            },
            success: function (data) {
                datos = data.split(";");

                if (datos[1] == 1) {
                    alert("Alumno reprobado");
                }
                else {
                    alert(datos[2]);
                }
            }
        });
    }
    else{
        alert("Seleccione un curso");
    }
}