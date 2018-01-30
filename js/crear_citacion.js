$(document).ready(function () {
    $("#guardar").click(function () {
        var fecha = $("#fecha").val();
        var hora = $("#hora").val();
        var detalle = $("#detalle").val();
        var alumno = $("#alumno").val();
        var ins = $("#ins").val();
        var date = new Date();

        var actual = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

alert(actual+"| |"+fecha);

        if(fecha != "" && hora != "" && detalle != ""){
        //   if(fecha > actual) {
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

                        }
                        else {
                            alert("Error al crear la citacion");
                        }
                    }
                });
           /*}
            else{
                alert("La fecha debe ser mayor a la de hoy");
            }*/
        }
        else{
            alert("Todos los campos son necesarios");
        }
    });
});