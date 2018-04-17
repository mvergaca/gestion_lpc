<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"];

    $sql = "SELECT * FROM asistencia
            INNER JOIN alumno ON alumno.id_alumno = asistencia.id_alumno
            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
            WHERE asistencia.fecha >= '$desde' and asistencia.fecha <= '$hasta' and asistencia.estado = 1
            order by asistencia.fecha";
    $res = $dbcon->query($sql);

    if(mysqli_num_rows($res) > 0){
        echo"|1|
        <table class='table table-bordered table-responsive'>
        <thead>
        <tr>
            <td class=\"col-sm-3\"><label>Alumno</label></td>
                        <td class=\"col-sm-3\"><label>Profesor</label></td>
                        <td class=\"col-sm-2\"><label>Fecha</label></td>
                        <td class=\"col-sm-2\"><label>Hora</label></td>
                        <td class=\"col-sm-2\"><label>Justificado</label></td>
        </tr>
        </thead>
        <tbody>";
        while($datos = mysqli_fetch_array($res)){
            echo"<tr>
                    <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                    <td>";
            $sql2 = "SELECT * FROM usuario 
                              INNER JOIN profesor ON profesor.rut_usr = usuario.rut_usr
                              WHERE profesor.id_profesor = $datos[id_profesor]";
            $res2 = $dbcon->query($sql2);
            while($datos2 = mysqli_fetch_array($res2)){
                echo"$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]";
            }

            echo"</td>
                        <td>$datos[fecha]</td>
                        <td>$datos[hora]</td>
                        <td>";
                        if($datos["justificacion"] == 0){
                            echo"SI";
                        }
                        else{
                            echo"NO";
                        }
                        echo"</td>
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