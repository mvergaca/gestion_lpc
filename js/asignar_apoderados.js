$(document).ready(function () {
    $("#guardar").click(function () {
        var alumno = $("#rut_alumno").val();
        var titular = $("#rut_titular").val();
        var suplente = $("#rut_suplente").val();

        if(alumno == "" || titular == "" || suplente == ""){
            alert("Todos los campos son obligatorios");
        }
        else{
            $.ajax({
                type: "POST",
                url: "asignar_apod.php",
                data: {  "alumno":alumno,
                    "titular":titular,
                    "suplente":suplente
                },
                success: function (data) {
                    datos = data.split(";");
                    if(datos[1] == 1){
                        alert("Apoderados asignados conexito");
                    }
                    else{
                        alert("Hay campos incorrectos o no se encuentran los usuarios en el sistema");
                    }
                }
            });
        }
    });
});

function cargar_datos_alumno() {
    var rut = $("#rut_alumno").val();

    $.ajax({
        type: "POST",
        url: "usuario_buscar_utp.php",
        data: {"rut":rut},
        success: function (data) {
            datos = data.split("|");
            if(datos[1] == 1){

                $("#datos_alumno").html(datos[2]);
            }
            else{
                if(rut != "") {
                    $("#datos_alumno").html("<label class='label-danger'>No se ha encontrado alumno asociado a ese rut</label>");
                }
            }
        }
    });
}

function cargar_datos_titular() {
    var rut = $("#rut_titular").val();

    $.ajax({
        type: "POST",
        url: "usuario_buscar_utp.php",
        data: {"rut":rut},
        success: function (data) {
            datos = data.split("|");
            if(datos[1] == 1){

                $("#datos_titular").html(datos[2]);

            }
            else{
                if(rut != "") {
                    $("#datos_titular").html("<label class='label-danger'>No se ha encontrado apoderad asociado a ese rut</label>");
                }
            }
        }
    });
}

function cargar_datos_suplente() {
    var rut = $("#rut_suplente").val();

    $.ajax({
        type: "POST",
        url: "usuario_buscar_utp.php",
        data: {"rut":rut},
        success: function (data) {
            datos = data.split("|");
            if(datos[1] == 1){

                $("#datos_suplente").html(datos[2]);

            }
            else{
                if(rut != "") {
                    $("#datos_suplente").html("<label class='label-danger'>No se ha encontrado apoderad asociado a ese rut</label>");
                }
            }
        }
    });
}