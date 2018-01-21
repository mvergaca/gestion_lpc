$(document).ready(function () {
    $("#quitar").hide();

    $("#guardar").click(function () {
        var curso = $("#curso").val();
        var alumno = $("#alumno").val();
        var descripcion = $("#descripcion").val();
        var imagen = $("#ruta").val();
        var asistente = $("#asistente").val();


        if(curso != "" && alumno != "" && descripcion != ""){
            if(imagen == ""){
                imagen = null;
            }


            $.ajax({
                type: "POST",
                url: "guardar_caso_social.php",
                data: {"curso":curso,
                        "alumno":alumno,
                        "descripcion":descripcion,
                        "imagen":imagen,
                        "asistente":asistente
                },
                success: function (data) {
                    datos = data.split(";");
                    if(datos[1] == 1){
                        alert(datos[2]);
                        window.location.href="ver_casos_sociales.php";
                    }
                    else{
                        alert(datos[2]);
                        alert("No se pudo guardar el caso");
                    }
                }
            });

        }
        else{
            alert("Curso, Alumno y Descripcion son obligatorios");
        }

    });

    $("#quitar").click(function () {
        $("#img_sel").html("");
        $("#ruta").val("");
        $("#quitar").hide();
    });
});

function cargar_curso() {
    var curso = $("#curso").val();

    $.ajax({
        type: "POST",
        url: "cargar_curso.php",
        data: {"curso":curso
        },
        success: function (data) {
            datos = data.split(";");
            if(datos[1] == 1){
                $("#alumno").html(datos[2]);
            }
            else{
                $("#alumno").html(datos[2]);
            }
        }
    });
}

function subir_archivo(ref){
    var file_data = ref.files[0];
    var form_data = new FormData();
    form_data.append('file',file_data);


    $.ajax({
        async: false,
        url: "subir_archivo_caso.php",
        type: "POST",
        cache: false,
        data: form_data,
        contentType: false,
        processData: false,
        success: function(data)
        {
            datos = data.split(";");
            if(datos[1] == 1){
                if(datos[3]!= "application/pdf"){
                    $("#img_sel").html("<img src='"+datos[2]+"'>");
                }
                else{
                    $("#img_sel").html("<img src='imagenes/pdf.png'>");
                }
                $("#ruta").val(datos[2]);
                $("#quitar").show();
                alert(datos[3]);
            }else{
                alert(0+datos[2]);
            }
        }
    });
}