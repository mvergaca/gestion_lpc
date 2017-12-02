$(document).ready(function () {
    $("#guardar").click(function () {
        var curso = $("#curso").val();
        var clase = $("#clase").val();
        var horario = $("#horario").val();
        var dia = $("#dia").val();

        if(curso == "" || horario == "" || dia == "" || clase == ""){
            alert("Todos los campos son obligatorios");
        }
        else{
            $.ajax({
                type: "POST",
                url: "insertar_distribucion.php",
                data: {
                    "curso": curso,
                    "clase": clase,
                    "horario":horario,
                    "dia":dia
                },
                success: function (data) {
                    datos = data.split("|");
                    if (datos[1] == 1) {
                        alert("Se agrego al horario");
                        $("#mostrar").html(datos[2]);
                        $("#alerta").html("");
                    }
                    else {
                        $("#alerta").html(datos[2]);
                    }
                }
            });
        }
    });
});

function eliminar_dist(curso, horario, dia, clase) {
    if(dia == 1){
        var day = 'lunes';
    }
    if(dia == 2){
        var day = 'martes';
    }
    if(dia == 3){
        var day = 'miercoles';
    }
    if(dia == 4){
        var day = 'jueves';
    }
    if(dia == 5){
        var day = 'viernes';
    }
$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "eliminar_distribucion.php",
        data: {
            "curso": curso,
            "clase": clase,
            "horario":horario,
            "dia":day
        },
        success: function (data) {
            datos = data.split("|");
            if (datos[1] == 1) {
                alert("Se quito al horario");
                $("#mostrar").html(datos[2]);
                $("#alerta").html("");
            }
            else {
                $("#alerta").html(datos[2]);
            }
        }
    });
})
}