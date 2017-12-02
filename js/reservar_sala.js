$(document).ready(function () {
    $("#guardar").click(function () {
        var sala = $("#sala").val();
        var profesor = $("#prof").val();
        var fecha = $("#fecha").val();
        var bloque = $("#bloque").val();

        if(sala != "" && profesor != "" && fecha != "" && bloque != "") {
            $.ajax({
                type: "POST",
                url: "guardar_reserva.php",
                data: {
                    "sala": sala,
                    "profesor": profesor,
                    "fecha": fecha,
                    "bloque": bloque
                },
                success: function (data) {
                datos = data.split("|");
                    if (datos[1] == 1) {
                        alert("Reservado exitosamente");
                        $("#lista").html(datos[2]);
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

function editar_reserva(ref) {
    window.location.href = "editar_reserva.php?id="+ref;
}

function eliminar_reserva(ref) {
    var sala = $("#sala").val();
    $.ajax({
        type: "POST",
        url: "eliminar_reserva.php",
        data: {
            "ref": ref,
            "sala":sala
        },
        success: function (data) {
            datos = data.split("|");
            if (datos[1] == 1) {
                alert("Se elimino la reserva");
                $("#lista").html(datos[2]);
            }
            else {
                alert("No se pudo eliminar la reserva");
            }
        }
    });
}