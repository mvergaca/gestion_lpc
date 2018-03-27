$(document).ready(function () {
   $("#justificar").click(function () {
       var id_alumno = $("#id_alumno").val();
       var id_apoderado = $("#apoderado").val();
       var motivo = $("#motivo").val();

       if(id_apoderado != "" || motivo != ""){
           $.ajax({
               type: "POST",
               url: "justificar.php",
               data: {"id_alumno":id_alumno,
                   "id_apoderado":id_apoderado,
                   "motivo":motivo
               },
               success: function (data) {
                   datos = data.split(";");
                   if(datos[1] == 1){
                       alert("Justificado exitosamente");
                       window.location.href = "inicio_inspector.php";
                   }
                   else{
                       alert("No se pudo justificar el alumno");
                   }
               }
           });
       }
       else{
           alert("Todos los campos son obligatorios");
       }

   });
});