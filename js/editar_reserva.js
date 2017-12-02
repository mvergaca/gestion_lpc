$(document).ready(function () {
    $("#guardar").click(function () {

        var sala = $("#sala").val();
        var profesor = $("#prof").val();
        var fecha = $("#fecha").val();
        var bloque = $("#bloque").val();

        if(sala != "" && profesor != "" && fecha != "" && bloque != "") {
            $.ajax({
                type: "POST",
                url: "reserva_editar.php",
                data: {
                    "sala": sala,
                    "profesor": profesor,
                    "fecha": fecha,
                    "bloque": bloque
                },
                success: function (data) {
                    datos = data.split("|");
                    if (datos[1] == 1) {
                        alert("Se edito la reserva");
                        window.location.href = "reservar_sala.php?id=" + sala;
                    }
                    else {
                        alert("Ya existe una reserva en ese horario para la fecha seleccionada");
                    }
                }
            });
        }
        else{
            alert("¡Todos los campos son obligatorios!");
        }

    });
});