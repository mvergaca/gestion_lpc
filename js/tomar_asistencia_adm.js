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
        var fecha_actual = Anio + "-" + parseInt(Mes + 1) + "-" + Dia;
        var hora_actual = H + ":" + M + ":" + S;

        var usu = $("#usuario").val();
        var asig = $("#asignatura").val();
        var curso = $("#curso").val();
        var num = $("[name='check']").length;
        var consulta = "insert into asistencia (id_profesor, id_alumno,id_asignatura, estado, fecha, hora, justificacion) values ";
        var estado;

        if(asig != "") {
            for (var i = 1; i <= num; i++) {
                var est = $("#id_estudiante_" + i).val();
                var verif = $("#asistencia_" + i).prop('checked');

                if (verif) {
                    estado = 0;
                }
                else {
                    estado = 1;
                }

                if (i != num) {
                    consulta = consulta + "(" + usu + "," + est + "," + asig + "," + estado + ",'"+fecha_actual+"','" + hora_actual + "',1),";
                }
                else {
                    consulta = consulta + "(" + usu + "," + est + "," + asig + "," + estado + ",'"+fecha_actual+"','" + hora_actual + "',1);";
                }
            }

            $.ajax({
                type: "POST",
                url: "insertar_asistencia.php",
                data: {"consulta": consulta},
                success: function (data) {
                    datos = data.split(";");
                    if (datos[1] == 1) {
                        window.location.href="ver_asistencia_adm.php?curso="+curso+"&asi="+asig;

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