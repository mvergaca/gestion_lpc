function justificar(ref) {
    $.ajax({
        type: "POST",
        url: "justificar.php",
        data: {
            "alumno": ref
        },
        success: function (data) {
            datos = data.split("|");
            if (datos[1] == 1) {
                $("#contenido").html(datos[2]);
            }
            else {
                alert("No se pudo justificar l alumno");
            }
        }
    });
}