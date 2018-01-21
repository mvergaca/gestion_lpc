<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $caso = $_POST["caso"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_POST["imagen"];

    $fecha = date("Y-m-d");
    $hora = null;


    if($imagen == null || $descripcion == null){
        $sql = "UPDATE caso_social SET descripcion_caso = '$descripcion', imagen = '$imagen' WHERE id_caso_social = $caso";
    }
    else{
        $sql = "UPDATE caso_social SET descripcion_caso = '$descripcion', imagen = '$imagen', estado = 0 WHERE id_caso_social = $caso";
    }

    $resu = $dbcon ->query($sql);

    if(!$resu){
        echo";-1;$sql;";
    }
    else{
        echo";1;$sql;";
    }

    $resu->close();
    include "cerrar_conexion.php";
}
?>