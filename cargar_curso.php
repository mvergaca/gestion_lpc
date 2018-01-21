<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $curso = $_POST["curso"];

    $sql = "SELECT * FROM alumno
            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
            INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
            WHERE lista.id_curso = $curso AND lista.anio = YEAR(NOW())";

    $resu = $dbcon ->query($sql);
    if(mysqli_num_rows($resu) > 0){
        echo";1;<option value=''> - - - </option>";
        while ($datos = mysqli_fetch_array($resu)){
            echo"<option style='font-size: 12px' value='$datos[id_alumno]'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</option>";
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