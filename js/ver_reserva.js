$(document).ready(function () {
    $("#buscar").click(function () {
        var sala = $("#sala").val();
        var desde = $("#desde").val();
        var hasta = $("#hasta").val();

        if(sala != "" && desde != "" && hasta != ""){
            if(desde > hasta){
                alert("Desde debe ser menor que hasta")
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "reservas_ver.php",
                    data: {
                        "sala": sala,
                        "desde":desde,
                        "hasta":hasta
                    },
                    success: function (data) {
                        datos = data.split("|");
                        if (datos[1] == 1) {
                            $("#lista").html(datos[2]);
                        }
                        else{
                            alert("Error en la busqueda de reservas");
                        }
                    }
                });

            }
        }
        else{
            alert("Todos los campos son obligatorios")
        }

    });
});