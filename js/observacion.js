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

    var tiempo = new Date();

    var dia = tiempo.getDate();
    var mes = tiempo.getMonth();
    var anio = tiempo.getFullYear();

    var hora = tiempo.getHours();
    var min = tiempo.getMinutes();
    var sec = tiempo.getSeconds();

    var actual = anio+"-"+mes+"-"+dia+" "+hora+":"+min+":"+sec;


    if(alumno != "") {
        if (observacion != "") {
            var consulta = "insert into observacion (id_profesor, id_alumno, observacion, fecha_hora, tipo_obs) values (" + profesor + "," + alumno + ",'" + observacion + "','"+actual+"',"+tipo+");";

            $.ajax({
                type: "POST",
                url: "insertar_observacion.php",
                data: {"consulta":consulta},
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