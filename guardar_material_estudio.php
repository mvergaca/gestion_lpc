<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $clase = $_POST['clase'];
    $profesor = $_POST['profesor'];
    $ruta = $_POST['ruta'];
    $detalle = $_POST['detalle'];

    $sql = "INSERT INTO material_estudiantil(id_profesor, id_clase, fecha, detalle, dir_material) 
            VALUES ($profesor,$clase,NOW(),'$detalle','$ruta')";

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