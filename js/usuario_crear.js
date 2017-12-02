$(document).ready(function () {
    $("#genero_m").attr("checked",true);

   $("#guardar").click(function () {
       var rut = $("#rut").val();
       var nombre = $("#nombre").val();
       var apellido_p = $("#apellido_p").val();
       var apellido_m = $("#apellido_m").val();
       var fecha_n = $("#fecha_n").val();
       var telefono = $("#telefono").val();
       var correo = $("#correo").val();
       var direccion = $("#direccion").val();
       var comuna = $("#comuna").val();
       var tipo_usuario = $("#tipo_usuario").val();

       if(rut == "" || nombre == "" || apellido_p == "" || apellido_m == "" || fecha_n == "" || telefono == ""
            || correo == "" || direccion == "" || comuna == "" || tipo_usuario == ""){
            alert("Todos los campos son obligatorios");
       }
       else{
           if($("#genero_m").is(":checked")){
               var genero = "M";
           }else {
               if($("#genero_f").is(":checked")){
                   var genero = "F";
               }
           }

           $.ajax({
               type: "POST",
               url: "insertar_usuario.php",
               data: {  "rut":rut,
                        "nombre":nombre,
                        "apellido_p":apellido_p,
                        "apellido_m":apellido_m,
                        "fecha_n":fecha_n,
                        "telefono":telefono,
                        "correo":correo,
                        "direccion":direccion,
                        "comuna":comuna,
                        "tipo_usuario":tipo_usuario,
                        "genero":genero
               },
               success: function (data) {
                   datos = data.split(";");
                   if(datos[1] == 1){
                       alert("Usuario registrado exitosamente");
                   }
                   else{
                       alert("Error al ingresar el usuario");
                       alert(datos[1]);
                   }
               }
           });

       }





   }); 
});