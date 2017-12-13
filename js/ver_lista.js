$(document).ready(function () {
    $("#asistencia").click(function () {
        var curso = $("#curso").val();
        window.location.href="tomar_asistencia_adm.php?curso="+curso;
    });
});

function ver_alumno(ref) {
    window.location.href = "ver_alumno_adm.php?id="+ref;
}