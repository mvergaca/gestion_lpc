$(document).ready(function () {
    $("#guardar").click(function () {
        var estable = $("#establecimiento").val();
        var sala = $("#sala").val();
        var profesor = $("#profesor").val();
        var nombre = $("#nombre").val();


        if(estable == "" || nombre == ""){
            alert("Establecimiento y nombre de curso son obligatorios!");
        }
        if(sala == ""){
            sala = "NULL";
        }
        if(profesor == ""){
            profesor = "NULL";
        }

        $.ajax({
            type: "POST",
            url: "insertar_curso.php",
            data: {"estable":estable,
                "sala":sala,
                "profesor":profesor,
                "nombre":nombre
            },
            success: function (data) {
                datos = data.split(";");
                if(datos[1] == 1){
                    alert("Curso creado exitosamente");
                }
                else{
                    alert("Error al crear el curso");
                }
            }
        });
    });
});