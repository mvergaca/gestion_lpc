<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $semestre = $_POST["semestre"];
    $inicio = $_POST["inicio"];
    $fin = $_POST["fin"];
    $sem = $_POST["sem"];

    $sql = "UPDATE semestre SET inicio_semestre = '$inicio', fin_semestre = '$fin' , nombre_sem = '$semestre' WHERE id_semestre = $sem";

    $res = $dbcon ->query($sql);
    if(!$res){
        echo";-1;;";
    }
    else{
        echo";1;;";
    }
    $res->close();
    include "cerrar_conexion.php";
}
?>