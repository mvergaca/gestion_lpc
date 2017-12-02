<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $curso = $_POST['curso'];


        $sql = "DELETE FROM curso WHERE id_curso = $curso";
        $resu = $dbcon ->query($sql);

        if(!$resu){
            echo ";-1;";
        }
        else{
            echo ";1;";
        }
        $resu->close();

    include "cerrar_conexion.php";
}
?>