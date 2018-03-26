<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $alumno = $_POST["alumno"];
    $titular = $_POST["titular"];
    $suplente = $_POST["suplente"];


    $sql = "SELECT * FROM alumno WHERE rut_usr = '$alumno'";
    $res = $dbcon -> query($sql);

    $sql2 = "SELECT * FROM apoderado WHERE rut_usr = '$titular'";
    $res2 = $dbcon -> query($sql2);

    while( $datos2 = mysqli_fetch_array($res2)){
        $id_titular = $datos2["id_apoderado"];
    }

    $sql3 = "SELECT * FROM apoderado WHERE rut_usr = '$suplente'";
    $res3 = $dbcon -> query($sql3);

    while( $datos3 = mysqli_fetch_array($res3)){
        $id_suplente = $datos3["id_apoderado"];
    }

    $can_a = mysqli_num_rows($res);
    $can_t = mysqli_num_rows($res2);
    $can_s = mysqli_num_rows($res3);

    if($can_a > 0 || $can_t > 0 || $can_s > 0){
        echo";1;;";

        $sql4 = "UPDATE alumno SET id_apoderado = $id_titular, id_suplente = $id_suplente WHERE rut_usr = '$alumno'";
        $res4 = $dbcon -> query($sql4);

    }else{
        echo";-1;;";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>