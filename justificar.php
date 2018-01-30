<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $alumno = $_POST['alumno'];

    $sql2 = "UPDATE asistencia SET justificacion = 0 WHERE id_alumno = $alumno";

    $resu2 = $dbcon ->query($sql2);

    if($resu2){
        echo"|1|";
        $sql = "SELECT DISTINCT  alumno.id_alumno, alumno.rut_usr, usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr,
                curso.id_curso, curso.nombre_curso, asistencia.fecha
                FROM asistencia 
                INNER JOIN alumno ON alumno.id_alumno = asistencia.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                INNER JOIN curso ON curso.id_curso = lista.id_curso
                WHERE asistencia.estado = 0 AND asistencia.justificacion = 1
                ORDER BY curso.id_curso, usuario.nombre_usr";

        $res = $dbcon->query($sql);
        while ($datos = mysqli_fetch_array($res)) {
            echo "<tr>
                <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                <td>$datos[nombre_curso]</td>
                <td>$datos[fecha]</td>
                <td><input type='button' class='btn btn-danger' value='Justificar' onclick='justificar($datos[id_alumno]);'></td>
            </tr>";
        }
        echo"|";
    }
    else{
        echo"|-1||";
    }

    $resu2->close();
    include "cerrar_conexion.php";
}
?>