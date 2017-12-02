<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

$estable = $_POST["estable"];
$sala = $_POST["sala"];
$profesor = $_POST["profesor"];
$nombre = $_POST["nombre"];
$curso = $_POST["curso"];

    $sql = "UPDATE curso SET id_establecimiento = $estable, id_sala = $sala, id_profesor = $profesor, nombre_curso = '$nombre'
            WHERE id_curso = $curso";
    $res = $dbcon -> query($sql);

    if(!$res){
        echo";-1;;";
    }
    else{
        echo ";1;;";
    }
    include "cerrar_conexion.php";
}
?>