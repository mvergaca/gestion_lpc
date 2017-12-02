$(document).ready(function () {
    $("[name='check']").bootstrapSwitch();

    $("#guardar").click(function () {
        var tiempo = new Date();

        var Dia = tiempo.getDate();
        var Mes = tiempo.getMonth();
        var Anio = tiempo.getUTCFullYear();
        var H = tiempo.getHours();
        var M = tiempo.getMinutes();
        var S = tiempo.getSeconds();
        var hora_actual = Anio + "-" + parseInt(Mes + 1) + "-" + Dia + " " + H + "-" + M + "-" + S;

        var usu = $("#usuario").val();
        var asig = $("#asignatura").val();
        var num = $("[name='check']").length;
        var consulta = "insert into asistencia (id_profesor, id_alumno,id_asignatura, estado, fecha_hora) values ";
        var estado;

if(asig != "") {
    for (var i = 1; i <= num; i++) {
        var est = $("#id_estudiante_" + i).val();
        var verif = $("#asistencia_" + i).prop('checked');

        if (verif) {
            estado = 1;
        }
        else {
            estado = 0;
        }

        if (i != num) {
            consulta = consulta + "(" + usu + "," + est + "," + asig + "," + estado + ",'" + hora_actual + "'),";
        }
        else {
            consulta = consulta + "(" + usu + "," + est + "," + asig + "," + estado + ",'" + hora_actual + "');";
        }
    }

    $.ajax({
        type: "POST",
        url: "insertar_asistencia.php",
        data: {"consulta": consulta},
        success: function (data) {
            datos = data.split(";");
            if (datos[2] == 1) {
                alert("si");
                //window.location.href="ver_asistencia";

            }
            else {
                alert("Erro al guardar asistencia");
            }
        }
    });
}
else{
    alert("Selecciones una asignatura");
}
    });
});

