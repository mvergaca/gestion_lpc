$(document).ready(function () {
    $("#quitar").hide();

    $("#guardar").click(function () {
        var caso = $("#caso").val();
        var descripcion = $("#descripcion").val();
        var imagen = $("#ruta").val();


        if(descripcion != ""){
            if(imagen == ""){
                imagen = null;
            }
            else{
                alert(imagen);
            }

            $.ajax({
                type: "POST",
                url: "caso_social_editar.php",
                data: {"caso":caso,
                    "descripcion":descripcion,
                    "imagen":imagen
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
            alert("Descripcion es obligatoria");
        }

    });

    $("#quitar").click(function () {
        $("#img_sel").html("");
        $("#ruta").val("");
        $("#quitar").hide();
    });

});

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
            }else{
                alert(0+datos[2]);
            }
        }
    });
}