$(document).ready(function () {
    $("#guardar").click(function () {
        var semestre = $("#semestre").val();
        var inicio = $("#inicio").val();
        var fin = $("#termino").val();
        var id = $("#sem").val();

        if(semestre != "" || inicio != "" || fin != ""){
            if(inicio > fin) {
                alert("Fecha de inicio no sebe ser mayor a la de fin");
            }
            else{

                $.ajax({
                    type: "POST",
                    url: "semestre_editar.php",
                    data: {"semestre":semestre,
                        "inicio":inicio,
                        "fin":fin,
                        "sem":id
                    },
                    success: function (data) {
                        datos = data.split(";");
                        if(datos[1] == 1){
                            window.location.href="semestre.php";
                        }
                        else{
                            alert("Error al editar el Semestre");
                        }
                    }
                });

            }
        }
        else{
            alert("¡Todos los campos son obligatorios!");
        }
    });
});