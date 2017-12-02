$(document).ready(function () {
    $("#guardar_notas").click(function () {
        var num = $("[name='nota']").length;
        var asig = $("#asig").val();
        var curso = $("#curso").val();
        var detalle = $("#detalle").val();


        var consulta = "insert into nota (id_asignatura, id_alumno, nota, detalle, fecha_nota) values";
        var tiempo = new Date();
        var Dia = tiempo.getDate();
        var Mes = tiempo.getMonth();
        var Anio = tiempo.getUTCFullYear();
        var fecha = Anio+"-"+parseInt(Mes+1)+"-"+Dia;

        for(var i=1; i<=num; i++){
            var est = $("#est_"+i).val();
            var nota = $("#nota_"+i).val();
            if(nota > 7){
                nota = 7;
            }
            if(nota < 1){
                nota = 1;
            }
            if(i != num){
                if(detalle == ""){
                    var det = null;
                    consulta = consulta + "("+asig+","+est+","+nota+","+det+",'"+fecha+"'),";
                }
                else{
                    var det = detalle;
                    consulta = consulta + "("+asig+","+est+","+nota+",'"+det+"','"+fecha+"'),";
                }
            }
            else{
                if(detalle == ""){
                    var det = null;
                    consulta = consulta + "("+asig+","+est+","+nota+","+det+",'"+fecha+"');";
                }
                else{
                    var det = detalle;
                    consulta = consulta + "("+asig+","+est+","+nota+",'"+det+"','"+fecha+"');";
                }
            }
        }

        $.ajax({
            type: "POST",
            url: "insertar_notas.php",
            data: {"consulta":consulta},
            success: function (data) {
                $(location).attr('href','ver_notas_asignatura.php?curso='+curso+'&asig='+asig);
            }
        });
    });

});