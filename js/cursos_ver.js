function ver_lista(ref) {
    window.location.href = "ver_lista.php?id="+ref;
}

function editar_curso(ref) {
    window.location.href = "curso_editar.php?id="+ref;
}

function eliminar_curso(ref, fila) {
    $("#fila_"+fila).remove();

    $.ajax({
        type: "POST",
        url: "curso_eliminar.php",
        data: {"curso":ref
        },
        success: function (data) {
            datos = data.split(";");
            if(datos[1] == 1){
                alert("Curso eliminado exitosamente");
            }
            else{
                alert("Error al eliminar el curso");
            }
        }
    });

}