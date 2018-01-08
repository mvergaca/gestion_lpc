<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $nombre = $_POST["nombre"];
    $apellido_p = $_POST["apellido_p"];
    $apellido_m = $_POST["apellido_m"];
    $fecha_n = $_POST["fecha_n"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];
    $comuna = $_POST["comuna"];
    $genero = $_POST["genero"];

    $sql = "UPDATE usuario SET nombre_usr = '$nombre', apellido_p_usr = '$apellido_p', apellido_m_usr = '$apellido_m',
            fecha_n_usr = '$fecha_n', telefono_usr = '$telefono', correo_usr = '$correo', direccion_usr = '$direccion',
            comuna_usr = '$comuna', genero_usr = '$genero' 
            WHERE rut_usr = '$_SESSION[rut_usr]'";
    $res = $dbcon -> query($sql);

    if(!$res){
        echo";-1;;";
    }
    else{
        echo";1;;";
    }
    $res->close();

    include "cerrar_conexion.php";
}
?>