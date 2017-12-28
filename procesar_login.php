<?php
if(isset($_POST["user"]) && isset($_POST["pass"])){
    session_start();
    include "conexion.php";

    $user = $_POST["user"];
    $pass = $_POST["pass"];

    $sql = "SELECT us.rut_usr AS rut,
                    us.nombre_usr AS nombre,
                    us.apellido_p_usr AS apellido_p,
                    us.apellido_m_usr AS apellido_m,
                    adm.id_administrador AS id_adm,
                    al.id_alumno AS id_al,
                    ap.id_apoderado AS id_ap,
                    asi.id_asistente AS id_asi,
                    dir.id_director AS id_dir,
                    ins.id_inspector AS id_ins,
                    prof.id_profesor AS id_prof,
                    sec.id_secretaria AS id_sec,
                    utp.id_utp AS id_utp
            FROM usuario us
            LEFT JOIN administrador adm ON us.rut_usr = adm.rut_usr
            LEFT JOIN alumno al ON us.rut_usr = al.rut_usr
            LEFT JOIN apoderado ap ON us.rut_usr = ap.rut_usr
            LEFT JOIN asistente asi ON us.rut_usr = asi.rut_usr
            LEFT JOIN director dir ON us.rut_usr = dir.rut_usr
            LEFT JOIN inspector ins ON us.rut_usr = ins.rut_usr
            LEFT JOIN profesor prof ON us.rut_usr = prof.rut_usr
            LEFT JOIN secretaria sec ON us.rut_usr = sec.rut_usr
            LEFT JOIN utp ON us.rut_usr = utp.rut_usr
            WHERE us.rut_usr = '$user' AND us.pass_usr = MD5('$pass')";

    //echo"$sql";
    //$result = mysqli_query($dbcon,$sql) or die(mysqli_error());

    $result = $dbcon ->query($sql);
    //echo"$result";

    $_SESSION['conectado'] = "";

    while($datos = mysqli_fetch_array($result)){
        $_SESSION['conectado'] = "si";
        $_SESSION['rut_usr'] = $datos["rut"];
        $_SESSION['nombre'] = $datos["nombre"];
        $_SESSION['apellido_p'] = $datos["apellido_p"];
        $_SESSION['apellido_m'] = $datos["apellido_m"];


        if($datos['id_adm'] != NULL){
            $_SESSION['tipo_usuario'] = '1';
        }
        if($datos['id_al'] != NULL){
            $_SESSION['tipo_usuario'] = '2';
        }
        if($datos['id_ap'] != NULL){
            $_SESSION['tipo_usuario'] = '3';
        }
        if($datos['id_asi'] != NULL){
            $_SESSION['tipo_usuario'] = '4';
        }
        if($datos['id_dir'] != NULL){
            $_SESSION['tipo_usuario'] = '5';
        }
        if($datos['id_prof'] != NULL){
            $_SESSION['tipo_usuario'] = '6';
        }
        if($datos['id_sec'] != NULL){
            $_SESSION['tipo_usuario'] = '7';
        }
        if($datos['id_utp'] != NULL){
            $_SESSION['tipo_usuario'] = '8';
        }
        if($datos['id_ins'] != NULL){
            $_SESSION['tipo_usuario'] = '9';
        }
    }

    mysqli_free_result($result);

    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "1"){
    header("Location: inicio_administrador.php");
    }
    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "2"){
    header("Location: inicio_alumno.php");
    }
    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "3"){
        header("Location: inicio_apoderado.php");
    }
    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "4"){
        header("Location: inicio_asistente.php");
    }
    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "5"){
        header("Location: inicio_director.php");
    }
    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "6"){
        header("Location: inicio_profesor.php");
    }
    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "7"){
        header("Location: inicio_secretaria.php");
    }
    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "8"){
        header("Location: inicio_utp.php");
    }
    if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "9"){
        header("Location: inicio_inspector.php");
    }
    if($_SESSION['conectado'] != "si"){
        $_SESSION['conectado'] = "no";
        header("Location: index.php");
    }

    include "cerrar_conexion.php";

}else{
    header ("Location: index.php");
}

?>