<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $id_sala = $_POST['id'];
    $nombre = $_POST['nombre'];
    $encargado = $_POST['encargado'];

    $sql = "UPDATE sala SET nombre_sala = '$nombre', encargado = '$encargado' WHERE id_sala = $id_sala";

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