$(document).ready(function () {

$("#guardar").click(function () {

    var alumno = $("#alumnos").val();
    var observacion = $("#observacion").val();
    var profesor = $("#profesor").val();

    if($("#positiva").prop('checked')){
        var tipo = 1;
    }
    if($("#negativa").prop('checked')){
        var tipo = 0;
    }


    if(alumno != "") {
        if (observacion != "") {

            $.ajax({
                type: "POST",
                url: "insertar_observacion.php",
                data: {"alumno":alumno,
                    "observacion":observacion,
                    "profesor":profesor,
                    "tipo":tipo
                },
                success: function (data) {
                    datos = data.split(";");
                    if(datos[1] == 1){
                        var curso = $("#curso").val();
                        var asig = $("#asig").val();
                        window.location.href = "ver_observaciones.php?curso="+curso+"&asi="+asig;
                    }
                }
            });
        } else {
            alert("observacion vacia");
        }
    }
    else{
        alert("Seleccione un alumno");
    }
});
});