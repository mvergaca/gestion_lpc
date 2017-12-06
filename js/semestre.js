$(document).ready(function () {
    $("#guardar").click(function () {
        var semestre = $("#semestre").val();
        var inicio = $("#inicio").val();
        var fin = $("#termino").val();

        if(semestre != "" || inicio != "" || fin != ""){
            if(inicio > fin){
                alert("Fecha de inicio no sebe ser mayor a la de fin");
            }
            else{

                $.ajax({
                    type: "POST",
                    url: "crear_semestre.php",
                    data: {"semestre":semestre,
                            "inicio":inicio,
                            "fin":fin
                            },
                    success: function (data) {
                        datos = data.split("|");
                        if(datos[1] == 1){
                            $("#lista").html(datos[2]);
                        }
                        else{
                            alert(datos[2]);
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

function editar_semestre(id){
    window.location.href = "editar_semestre.php?id="+id;
}

function eliminar_semestre(id, ref) {
    $.ajax({
        type: "POST",
        url: "eliminar_semestre.php",
        data: {"id":id
        },
        success: function (data) {
            datos = data.split(";");
            if(datos[1] == 1){
                alert("Semestre eliminado");
                $("#fila_"+ref).remove();
            }
            else{
                alert("No se pudo eliminar el semestre");
            }
        }
    });
}