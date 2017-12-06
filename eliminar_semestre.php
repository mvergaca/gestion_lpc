<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $id = $_POST["id"];

    $sql = "DELETE FROM semestre WHERE id_semestre = $id";

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