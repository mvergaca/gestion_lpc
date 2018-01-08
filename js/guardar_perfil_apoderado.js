$(document).ready(function () {
    $("#guardar").click(function () {
        var nombre = $("#nombre").val();
        var apellido_p = $("#apellido_p").val();
        var apellido_m = $("#apellido_m").val();
        var fecha_n = $("#fecha_n").val();
        var telefono = $("#telefono").val();
        var correo = $("#correo").val();
        var direccion = $("#direccion").val();
        var comuna = $("#comuna").val();
        var tipo_usuario = $("#tipo_usuario").val();

        if($("#genero_m").is(":checked")){
            var genero = "M";
        }else {
            if($("#genero_f").is(":checked")){
                var genero = "F";
            }
            else{
                genero = null;
            }
        }

        if(nombre == "" || apellido_p == "" || apellido_m == "" || fecha_n == "" || telefono == ""
            || correo == "" || direccion == "" || comuna == "" || tipo_usuario == "" || genero == null){
            alert("Todos los campos son obligatorios");
        }
        else{

            $.ajax({
                type: "POST",
                url: "guardar_perfil.php",
                data: {
                    "nombre":nombre,
                    "apellido_p":apellido_p,
                    "apellido_m":apellido_m,
                    "fecha_n":fecha_n,
                    "telefono":telefono,
                    "correo":correo,
                    "direccion":direccion,
                    "comuna":comuna,
                    "genero":genero
                },
                success: function (data) {
                    datos = data.split(";");
                    if(datos[1] == 1){
                        alert("Datos guardados exitosamente");
                        window.location.href = "modificar_perfil_apoderado.php";
                    }
                    else{
                        alert("Error al guardar los datos");

                    }
                }
            });

        }


    });
});