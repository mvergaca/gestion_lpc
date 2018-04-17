$(document).ready(function () {
    $("#guardar").click(function () {
        var fecha = $("#fecha").val();
        var hora = $("#hora").val();
        var detalle = $("#detalle").val();
        var alumno = $("#alumno").val();
        var ins = $("#ins").val();
        var date = new Date();

        var anio_actual = date.getFullYear();
        var mes_actual = date.getMonth()+1;
        var dia_actual = date.getDate();

        if(mes_actual < 10){
            mes_actual = "0"+mes_actual;
        }
        if(dia_actual < 10){
            dia_actual = "0"+dia_actual;
        }

        var actual = anio_actual+"-"+mes_actual+"-"+dia_actual;

        if(fecha != "" && hora != "" && detalle != ""){
           if(fecha > actual) {
                $.ajax({
                    type: "POST",
                    url: "guardar_citacion.php",
                    data: {
                        "fecha": fecha,
                        "hora": hora,
                        "detalle": detalle,
                        "alumno": alumno,
                        "ins": ins
                    },
                    success: function (data) {
                        datos = data.split(";");
                        if (datos[1] == 1) {
                            window.location.href = "ver_citacion.php?id="+datos[2];
                        }
                        else {
                            alert("Error al crear la citacion");
                        }
                    }
                });
           }
            else{
                alert("La fecha debe ser mayor a la de hoy");
            }
        }
        else{
            alert("Todos los campos son necesarios");
        }
    });
});