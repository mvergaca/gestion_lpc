$(document).ready(function () {
    $("[name = 'texto']").prop("disabled",true);
    $("[name = 'guardar']").hide();
});
function modificar(ref) {
    $("#texto_"+ref).prop("disabled",false);
    $("#guardar_"+ref).show();
    $("#modificar_"+ref).hide();
}
function guardar(ref) {
    $("#texto_"+ref).prop("disabled",true);
    $("#guardar_"+ref).hide();
    $("#modificar_"+ref).show();
}
function eliminar(ref) {
    $("#fila_"+ref).hide();
}