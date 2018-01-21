$(document).ready(function () {
    $("#quitar").hide();

    $("#publicar").click(function () {
        var clase = $("#clase").val();
        var profesor = $("#profesor").val();
        var ruta = $("#ruta").val();
        var curso = $("#curso").val();
        var asig = $("#asig").val();
        var detalle = $("#detalle").val();

        if(ruta != "" || detalle != "") {
            $.ajax({
                type: "POST",
                url: "guardar_material_estudio.php",
                data: {
                    "clase": clase,
                    "profesor": profesor,
                    "ruta": ruta,
                    "detalle":detalle
                },
                success: function (data) {
                    datos = data.split(";");
                    if (datos[1] == 1) {
                        window.location.href = "archivos_publicados.php?curso="+curso+"&asigna="+asig;
                    }
                    else {
                        alert("No se pudo guardar el caso");
                    }
                }
            });
        }
        else{
            alert("Seleccione un archivo");
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
        url: "subir_material_estudio.php",
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
                alert(datos[2]);
            }
        }
    });
}