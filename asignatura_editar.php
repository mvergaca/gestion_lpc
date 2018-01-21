<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $id_asig = $_POST['id'];
    $nombre = $_POST['nombre'];
    $promediable = $_POST['promediable'];

    $sql = "UPDATE asignatura SET nombre_asignatura = '$nombre',promediable = $promediable WHERE id_asignatura = $id_asig";

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