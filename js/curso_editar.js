$(document).ready(function () {
    $("#guardar").click(function () {
        var estable = $("#establecimiento").val();
        var sala = $("#sala").val();
        var profesor = $("#profesor").val();
        var nombre = $("#nombre").val();
        var curso = $("#curso").val();

        if(estable == "" || nombre == ""){
            alert("Establecimiento y nombre de curso son obligatorios!");
        }
        if(sala == ""){
            sala = "null";
        }
        if(profesor == ""){
            profesor = 'null';
        }

        $.ajax({
            type: "POST",
            url: "modificar_curso.php",
            data: {"estable":estable,
                "sala":sala,
                "profesor":profesor,
                "nombre":nombre,
                "curso":curso
            },
            success: function (data) {
                datos = data.split(";");
                if(datos[1] == 1){
                    alert("Curso modificado exitosamente");
                    window.location.href = "cursos_ver.php";
                }
                else{
                    alert("Error al modificar el curso");
                    alert(datos[2]);
                }
            }
        });
    });
});