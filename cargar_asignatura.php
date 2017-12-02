<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $curso = $_POST["curso"];

    $sql = "SELECT * FROM curso 
            INNER JOIN clase ON clase.id_curso = curso.id_curso
            INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
            WHERE curso.id_curso = '$curso'";

    $resu = $dbcon ->query($sql);
    if(mysqli_num_rows($resu) > 0){
        echo";1;<option value=''> - - - </option>";
        while ($datos = mysqli_fetch_array($resu)){
            echo"<option value='$datos[id_asignatura]'>$datos[nombre_asignatura]</option>";
        }
        echo";;";
    }
    else{
        echo";-1;<option value=''> - - - </option>;;";
    }

    $resu->close();
    include "cerrar_conexion.php";
}
?>