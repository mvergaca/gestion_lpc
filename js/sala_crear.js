$(document).ready(function () {
    $("#agregar").click(function () {
        var nombre = $("#nombre").val();
        var encargado = $("#encargado").val();

        if(encargado == ""){
            encargado = null;
        }

        $.ajax({
            type: "POST",
            url: "insertar_sala.php",
            data: {
                "nombre": nombre,
                "encargado":encargado
            },
            success: function (data) {
                datos = data.split("|");
                if (datos[1] == 1) {
                    alert("Se agrego la sala");
                    $("#lista").html(datos[2]);
                }
                else {
                    alert("No se pudo agregar la sala");
                }
            }
        });
    });
});

function editar_sala(id) {
    window.location.href = "editar_sala.php?id="+id;
}

function eliminar_sala(id) {
    $.ajax({
        type: "POST",
        url: "eliminar_sala.php",
        data: {
            "id": id
        },
        success: function (data) {
            datos = data.split("|");
            if (datos[1] == 1) {
                alert("Se elimino la sala");
                $("#lista").html(datos[2]);
            }
            else {
                alert("No se pudo eliminar la sala");
            }
        }
    });
}