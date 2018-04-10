function cargar_asignaturas() {
    var curso = $("#curso").val();

    $.ajax({
        type: "POST",
        url: "cargar_asignatura.php",
        data: {"curso":curso
        },
        success: function (data) {
            datos = data.split(";");
            if(datos[1] == 1){
                $("#asignatura").html(datos[2]);
            }
            else{
                $("#asignatura").html(datos[2]);
            }
        }
    });
}

function mostrar_curso() {
    var curso = $("#curso").val();
    var asigna = $("#asignatura").val();

    $.ajax({
        type: "POST",
        url: "seccion_notas.php",
        data: {"curso":curso,
                "asigna":asigna
        },
        success: function (data) {
            datos = data.split("|");
            if(datos[1] == 1){
                $("#notas").html(datos[2]);
            }
            else{
                $("#notas").html("<label class='label-warning'>No hay curso con esa asignatura</label>");
            }
        }
    });
}

function guardar_notas() {

    $(document).ready(function () {
            var num = $("[name='nota']").length;
            var asig = $("#asignatura").val();
            var curso = $("#curso").val();
            var detalle = $("#detalle").val();
            var semestre = $("#semestre").val();

if(semestre != "") {

    var consulta = "insert into nota (id_asignatura, id_alumno, nota, detalle, fecha_nota, id_semestre) values";
    var tiempo = new Date();
    var Dia = tiempo.getDate();
    var Mes = tiempo.getMonth();
    var Anio = tiempo.getUTCFullYear();
    var fecha = Anio + "-" + parseInt(Mes + 1) + "-" + Dia;

    for (var i = 1; i <= num; i++) {
        var est = $("#est_" + i).val();
        var nota = $("#nota_" + i).val();

        if (nota > 7.0) {
            alert("Verifique que las notas esten entre 1.0 y 7.0");
            break;
        }
        else{

            if (nota < 1) {
                alert("Verifique que las notas esten entre 1.0 y 7.0");
                break;
            }
            else{

                if (i != num) {
                    if (detalle == "") {
                        var det = null;
                        consulta = consulta + "(" + asig + "," + est + "," + nota + "," + det + ",'" + fecha + "',"+ semestre +"),";
                    }
                    else {
                        var det = detalle;
                        consulta = consulta + "(" + asig + "," + est + "," + nota + ",'" + det + "','" + fecha + "',"+ semestre +"),";
                    }
                }
                else {
                    if (detalle == "") {
                        var det = null;
                        consulta = consulta + "(" + asig + "," + est + "," + nota + "," + det + ",'" + fecha + "',"+ semestre +");";
                    }
                    else {
                        var det = detalle;
                        consulta = consulta + "(" + asig + "," + est + "," + nota + ",'" + det + "','" + fecha + "',"+ semestre +");";
                    }
                }

            }

        }

    }


    $.ajax({
        type: "POST",
        url: "insertar_notas.php",
        data: {"consulta": consulta},
        success: function (data) {
            datos = data.split(";");

            if(datos[1] == 1) {
                $(location).attr('href', 'ver_notas_asignatura.php?curso=' + curso + '&asig=' + asig);
            }
            else{
                alert("No se han ingresado las notas");
            }
        }
    });

}
else{
    alert("Semestre aun no esta disponible");
}

    });
}
