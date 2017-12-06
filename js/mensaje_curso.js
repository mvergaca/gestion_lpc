$(document).ready(function () {

    $("#guardar").click(function () {
        var curso = $("#cursos").val();
        var mensaje = $("#mensaje").val();
        var asig = $("#asignatura").val();
        var prof = $("#prof").val();

        if(curso != "") {
            if(mensaje != "") {
                var consulta = "insert into mensaje (id_curso, id_profesor, id_asignatura, mensaje) values ("+curso+","+prof+","+asig+",'"+mensaje+"');";

                $.ajax({
                    type: "POST",
                    url: "insertar_mensaje.php",
                    data: {"consulta":consulta},
                    success: function (data) {
                        datos = data.split(";");
                        if(datos[1] == 1){
                            alert(datos[2]);
                            $(location).attr('href','ver_clase.php?curso='+curso+'&asigna='+asig);
                        }
                        else{
                            alert(datos[2]);
                            alert("no se pudo guardar el mensaje");
                        }
                    }
                });
            }
            else{
                alert("Por favor escriba una observacion");
            }
        }
        else{
            alert("Seleccione un curso");
        }

    });
});