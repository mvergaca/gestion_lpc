$(document).ready(function () {

    $("#guardar").click(function () {
        var curso = $("#cursos").val();
        var mensaje = $("#mensaje").val();
        var asig = $("#asignatura").val();
        var prof = $("#prof").val();
        var fecha = $("#fecha").val();

        var date = new Date();

        var dia = date.getDate();
        var mes = date.getMonth()+1;
        var anio = date.getFullYear();

        if(mes < 10){
            mes = "0"+mes;
        }
        if(dia < 10){
            dia = "0"+dia;
        }

        var f_actual = anio+"-"+mes+"-"+dia;

        if(f_actual <= fecha) {
            if (curso != "") {
                if (mensaje != "") {
                    var consulta = "insert into mensaje (id_curso, id_profesor, id_asignatura, fecha_mensaje, mensaje) values (" + curso + "," + prof + "," + asig + ",'" + fecha + "','" + mensaje + "');";

                    $.ajax({
                        type: "POST",
                        url: "insertar_mensaje.php",
                        data: {"consulta": consulta},
                        success: function (data) {
                            datos = data.split(";");
                            if (datos[1] == 1) {
                                $(location).attr('href', 'ver_clase.php?curso=' + curso + '&asigna=' + asig);
                            }
                            else {
                                alert("no se pudo guardar el mensaje");
                            }
                        }
                    });
                }
                else {
                    alert("Por favor escriba un mensaje");
                }
            }
            else {
                alert("Seleccione un curso");
            }
        }
        else{
            alert("Ingrese una fecha mayor a la de hoy");
        }

    });
});