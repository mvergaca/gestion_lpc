$(document).ready(function () {
    $("#agregar").click(function () {
        var nombre = $("#asig").val();

        if($("#si").is(":checked")){
            var promediable = 1;
        }else{
            var promediable = 0;
        }

        if(nombre != "") {
            $.ajax({
                type: "POST",
                url: "insertar_asignatura.php",
                data: {
                    "nombre": nombre,
                    "promediable":promediable
                },
                success: function (data) {
                    datos = data.split("|");
                    if (datos[1] == 1) {
                        alert("Se agrego la asignatura");
                        $("#lista").html(datos[2]);
                    }
                    else {
                        alert(datos[2]);
                        alert("No se pudo agregar la asignatura");
                    }
                }
            });
        }
        else{
            alert("Debe ingresar un nombre ");
        }
    });
});

function editar_asignatura(id) {
    window.location.href = "editar_asignatura.php?id="+id;
}

function eliminar_asignatura(id) {
    $.ajax({
        type: "POST",
        url: "eliminar_asignatura.php",
        data: {
            "id": id
        },
        success: function (data) {
            datos = data.split("|");
            if (datos[1] == 1) {
                alert("Se elimino la asignatura");
                $("#lista").html(datos[2]);
            }
            else {
                alert("No se pudo eliminar la asignatura");
            }
        }
    });
}