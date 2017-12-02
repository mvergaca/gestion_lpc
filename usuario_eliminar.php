<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $rut = $_POST['rut'];
    $con = "SELECT * FROM usuario
            INNER JOIN administrador ON administrador.rut_usr = usuario.rut_usr
            WHERE usuario.rut_usr = '$rut'";
    $rescon = $dbcon ->query($con);

    if(mysqli_num_rows($rescon) > 0){
        echo ";-1;";
    }
    else{
        $sql = "DELETE FROM usuario WHERE rut_usr = '$rut'";
        $resu = $dbcon ->query($sql);
        if(!$resu){
            echo ";-1;";
        }
        else{
            echo ";1;";
        }
        $resu->close();
    }

    $rescon ->close();


    include "cerrar_conexion.php";
}
?>