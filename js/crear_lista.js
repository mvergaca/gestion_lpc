$(document).ready(function () {
    $("[name = 'quitar']").hide();
    $("#lista").hide();
    $("#agregar").hide();
    
    $("#nueva_fila").click(function () {

            var num = $("[name = 'agregar']").length;
            var sig = num + 1;
            var fila = "<tr id='fila_" +sig+ "'>" +
                "<td id='col_" + sig + "_1'><input type='text' id='rut_" + sig + "' class='form-control' placeholder='Rut'></td>" +
                "<td id='col_" + sig + "_2'><input type='hidden' id='est_" + sig + "'></td>" +
                "<td id='col_" + sig + "_3'>" +
                "<input type='button' name='agregar' id='agregar_" + sig + "' class='btn btn-success' value='Agregar' onclick='agregar_alumno(" + sig + ");'>" +
                "<input type='button' name='quitar' id='quitar_" + sig + "' class='btn btn-danger' value='Quitar' onclick='quitar_alumno(" + sig + ");'>" +
                "</td>" +
                "</tr>";
            $("#bod").append(fila);
            $("#quitar_"+sig).hide();

    });

    $("#cargar").click(function () {
        var curso = $("#curso").val();
        var anio = $("#año").val();

        if(anio != "") {

            $("#lista").show();
            $("#agregar").show();

            $.ajax({
                type: "POST",
                url: "cargar_lista.php",
                data: {
                    "curso": curso,
                    "anio": anio
                },
                success: function (data) {
                    datos = data.split("|");
                    if (datos[1] == 1) {
                        $("#bod").html(datos[2]);
                        var num = $("[name = 'agregar']").length;
                        for (var i = 1; i <= num; i++) {
                            $("#agregar_" + i).hide();
                        }
                    }
                    else {
                        alert("Curso sin lista");

                        var sig = 1;
                        var fila = "<tr id='fila_" + sig + "'>" +
                            "<td id='col_" + sig + "_1'><input type='text' id='rut_" + sig + "' class='form-control' placeholder='Rut'></td>" +
                            "<td id='col_" + sig + "_2'><input type='hidden' id='est_" + sig + "'></td>" +
                            "<td id='col_" + sig + "_3'>" +
                            "<input type='button' name='agregar' id='agregar_" + sig + "' class='btn btn-success' value='Agregar' onclick='agregar_alumno(" + sig + ");'>" +
                            "<input type='button' name='quitar' id='quitar_" + sig + "' class='btn btn-danger' value='Quitar' onclick='quitar_alumno(" + sig + ");'>" +
                            "</td>" +
                            "</tr>";

                        $("#bod").html(fila);
                        $("[name = 'quitar']").hide();
                    }
                }
            });
        }
        else{
            alert("El años es obligatorio");
        }
    });
});

function agregar_alumno(fila) {

    var rut = $("#rut_" + fila).val();
    var curso = $("#curso").val();
    var anio = $("#año").val();

    if(rut != "") {
        $.ajax({
            type: "POST",
            url: "agregar_alumno.php",
            data: {
                "rut": rut,
                "curso": curso,
                "anio": anio
            },
            success: function (data) {
                datos = data.split(";");
                if (datos[1] == -1) {
                    $("#col_" + fila + "_2").html(datos[2]);
                }
                else {
                    $("#quitar_" + fila).show();
                    $("#agregar_" + fila).hide();
                    $("#rut_" + fila).attr('disabled', true);

                    var dat = "<input type='hidden' id='est_"+fila+"' value='"+datos[2]+"'>"+datos[3]+" "+datos[4]+" "+datos[5];
                    $("#col_" + fila + "_2").html(dat);

                }
            }
        });
    }
    else{
        alert("Es necesario ingresar un rut");
    }
}


function quitar_alumno(fila) {

var alumno = $("#est_"+fila).val();
var anio = $("#año").val();

    $.ajax({
        type: "POST",
        url: "quitar_alumno.php",
        data: {
            "alumno": alumno,
            "anio": anio
        },
        success: function (data) {
            datos = data.split(";");
            if (datos[1] == 1) {
                $("#fila_"+fila).remove();
            }
            else {
                alert("Error al quitar alumno de la lista");
            }
        }
    });

}