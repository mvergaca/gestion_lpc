<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"];

    $sql = "SELECT * FROM citacion
            inner join alumno on alumno.id_alumno = citacion.id_alumno
            inner join usuario on usuario.rut_usr = alumno.rut_usr
            where citacion.fecha >= '$desde' and citacion.fecha <= '$hasta'
            order by citacion.fecha";
    $res = $dbcon->query($sql);

    if(mysqli_num_rows($res) > 0){
        echo"|1|
        <table class='table table-bordered table-responsive'>
        <thead>
        <tr>
                        <td class=\"col-sm-4\"><label>Alumno</label></td>
                        <td class=\"col-sm-2\"><label>Fecha</label></td>
                        <td class=\"col-sm-2\"><label>Hora</label></td>
                        <td class=\"col-sm-4\"><label>Motivo</label></td>
        </tr>
        </thead>
        <tbody>";
        while($datos = mysqli_fetch_array($res)){
            echo"
                        <tr>
                            <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                            <td>$datos[fecha]</td>
                            <td>$datos[hora]</td>
                            <td>$datos[motivo]</td>    
                        </tr>
                        ";
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