<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $id_asig = $_POST['id'];
    $nombre = $_POST['nombre'];

    $sql = "UPDATE asignatura SET nombre_asignatura = '$nombre' WHERE id_asignatura = $id_asig";

    $res = $dbcon ->query($sql);

    if($res){
        echo";1;;";
    }
    else{
        echo";-1;;";
    }
    $res->close();
    include "cerrar_conexion.php";
}
?>