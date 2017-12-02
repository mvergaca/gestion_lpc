<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $curso = $_POST["curso"];
    $asignatura = $_POST["asignatura"];
    $profesor = $_POST["profesor"];
    $anio = $_POST["anio"];
    $clase = $_POST["clase"];

    $sql="SELECT * FROM clase";

    $sql4 = "UPDATE clase SET id_curso = $curso, id_asignatura = $asignatura, id_profesor = $profesor, anio = $anio WHERE id_clase = $clase";

    $resu4 = $dbcon ->query($sql4);

    if($resu4){
        echo";1;;";
    }
    else{
        echo";-1;;";
    }

    $resu4->close();
    include "cerrar_conexion.php";
}
?>