<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"];

    $sql = "SELECT * FROM autorizacion
            INNER JOIN alumno ON alumno.id_alumno = autorizacion.id_alumno
            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
            where autorizacion.fecha >= '$desde' and autorizacion.fecha <= '$hasta'
            order by autorizacion.fecha";
    $res = $dbcon->query($sql);

    if(mysqli_num_rows($res) > 0){
        echo"|1|
        <table class='table table-bordered table-responsive'>
        <thead>
        <tr>
            <td class='col-sm-3'><label>Alumno</label></td>
            <td class='col-sm-3'><label>Apoderado</label></td>
            <td class='col-sm-3'><label>Motivo</label></td>
            <td class='col-sm-2'><label>Fecha</label></td>
            <td class='col-sm-1'><label>Hora</label></td>
        </tr>
        </thead>
        <tbody>";
            while($datos = mysqli_fetch_array($res)){
                echo"<tr>
                    <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                    <td>";
                $sql2 = "SELECT * FROM apoderado
                        INNER JOIN usuario on usuario.rut_usr = apoderado.rut_usr
                        where apoderado.id_apoderado = $datos[id_apoderado]";
                $res2 = $dbcon->query($sql2);
                while($datos2 = mysqli_fetch_array($res2)){
                    echo"$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]";
                }

                echo"</td>
                    <td>$datos[motivo]</td>
                    <td>$datos[fecha]</td>
                    <td>$datos[hora]</td>
                </tr>";
            }
        echo"</tbody>
        </table>
        |";
    }
    else{
        echo"|-1||";
    }

    include "cerrar_conexion.php";
}
?>