<?php

    include "conexion.php";

    $rut = $_POST["rut"];
    $correo = $_POST["correo"];



    $sql = "SELECT * FROM usuario WHERE rut_usr = '$rut'";
    $res = $dbcon -> query($sql);
    $filas = mysqli_num_rows($res);
    if($filas > 0){
        echo";1;;";
        $sql2 = "INSERT INTO recupera (rut_usr, correo, estado) VALUES ('$rut','$correo',1)";
        $res2 = $dbcon->query($sql2);
    }else{
        echo";-1;;";
    }

    $res->close();
    include "cerrar_conexion.php";
?>