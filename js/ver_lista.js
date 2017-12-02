$(document).ready(function () {
    $("#asistencia").click(function () {
        var curso = $("#curso").val();
        window.location.href="tomar_asistencia_adm.php?curso="+curso;
    });
});