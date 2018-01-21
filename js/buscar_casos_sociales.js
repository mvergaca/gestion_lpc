$(document).ready(function () {
    $("#buscar").click(function () {
        var desde = $("#desde").val();
        var hasta = $("#hasta").val();

        if(desde > hasta) {
            alert("desde debe menor que hasta!");
        }
        else{
            $.ajax({
                type: "POST",
                url: "casos_sociales_buscar.php",
                data: {
                    "desde": desde,
                    "hasta": hasta
                },
                success: function (data) {
                    datos = data.split("|");
                    if (datos[1] == 1) {
                        $("#filas").html(datos[2]);
                    }
                    else {
                        alert("No se han encontrado casos sociales");
                    }
                }
            });
        }

    });
});

function ver_caso(ref) {
    window.location.href = "ver_caso_social.php?id="+ref;
}