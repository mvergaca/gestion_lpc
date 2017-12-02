<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $estable = $_POST["estable"];
    $sala = $_POST["sala"];
    $profesor = $_POST["profesor"];
    $nombre = $_POST["nombre"];


    $sql = "INSERT INTO curso (id_profesor, id_establecimiento, id_sala, nombre_curso) VALUES ($profesor, $estable, $sala,'$nombre')";
    $res = $dbcon -> query($sql);

    if(!$res){
        echo";-1;;";
    }else{
        echo";1;;";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>