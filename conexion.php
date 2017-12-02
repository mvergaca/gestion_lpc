
<?php
// Conectando y seleccionado la base de datos
$dbcon = mysqli_connect('localhost','root','','lpc_bd');
$dbcon->set_charset("utf8");
function Tildes($palabra){
    $busca = array("á", "é", "í", "ó", "ú", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ñ");
    $reemplaza = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;");
    return str_replace($busca, $reemplaza, $palabra);
}
?>