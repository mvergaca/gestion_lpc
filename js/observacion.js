$(document).ready(function () {

$("#guardar").click(function () {

    var alumno = $("#alumnos").val();
    var observacion = $("#observacion").val();
    var profesor = $("#profesor").val();
    if(alumno != "") {
        if (observacion != "") {
            var consulta = "insert into observacion (id_profesor, id_alumno, observacion) values (" + profesor + "," + alumno + ",'" + observacion + "');";
            alert(consulta);
            $.ajax({
                type: "POST",
                url: "insertar_observacion.php",
                data: {"consulta":consulta},
                success: function (data) {
                    datos = data.split(";");
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