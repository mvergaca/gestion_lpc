<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

$rut = $_POST["rut"];
$nombre = $_POST["nombre"];
$apellido_p = $_POST["apellido_p"];
$apellido_m = $_POST["apellido_m"];
$fecha_n = $_POST["fecha_n"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$direccion = $_POST["direccion"];
$comuna = $_POST["comuna"];
$tipo_usuario = $_POST["tipo_usuario"];
$genero = $_POST["genero"];

$sql = "INSERT INTO usuario VALUES ('$rut',MD5('1234'),'$nombre','$apellido_p','$apellido_m','$fecha_n','$genero','$telefono','$correo','$direccion','$comuna')";
$res = $dbcon -> query($sql);

if(!$res){
    echo";-1;;";
}
else{
    if(strcmp($tipo_usuario,'administrador') == 0){
        $sql2 = "INSERT INTO administrador (rut_usr) VALUES ('$rut');";
    }
    if(strcmp($tipo_usuario,'alumno') == 0){
        $sql2 = "INSERT INTO alumno (rut_usr) VALUES ('$rut')";
    }
    if(strcmp($tipo_usuario,'apoderado') == 0){
        $sql2 = "INSERT INTO apoderado (rut_usr) VALUES ('$rut')";
    }
    if(strcmp($tipo_usuario,'asistente') == 0){
        $sql2 = "INSERT INTO asistente (rut_usr) VALUES ('$rut')";
    }
    if(strcmp($tipo_usuario,'director') == 0){
        $sql2 = "INSERT INTO director (rut_usr) VALUES ('$rut')";
    }
    if(strcmp($tipo_usuario,'profesor') == 0){
        $sql2 = "INSERT INTO profesor (rut_usr) VALUES ('$rut')";
    }
    if(strcmp($tipo_usuario,'secretaria') == 0){
        $sql2 = "INSERT INTO secretaria (rut_usr) VALUES ('$rut')";
    }
    if(strcmp($tipo_usuario,'utp') == 0){
        $sql2 = "INSERT INTO utp (rut_usr) VALUES ('$rut')";
    }

    $res2 = $dbcon ->query($sql2);
        $res2 ->close();
        if(!$res2) {
            echo ";-1;;";
        }
        else{
            echo";1;;";
        }
}
$res->close();
    include "cerrar_conexion.php";
}
?>