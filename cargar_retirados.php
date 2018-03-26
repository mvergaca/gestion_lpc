<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $anio = $_POST["anio"];

    $sql = "SELECT * FROM retirado 
                            INNER JOIN alumno ON alumno.rut_usr = retirado.rut_usr
                            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                            INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                            INNER JOIN curso ON curso.id_curso = lista.id_curso
                            WHERE lista.anio = $anio";

    $res = $dbcon ->query($sql);

    if(mysqli_num_rows($res) > 0){
        echo"|1|";

        echo"
        <table class=\"table table-bordered table-responsive\">
                    <thead>
                    <tr>
                        <td class=\"col-sm-4\"><label>Curso</label></td>
                        <td class=\"col-sm-6\"><label>Nombre</label></td>
                        <td class=\"col-sm-2\"><label>Fecha retiro</label></td>
                    </tr>
                    </thead>
                    <tbody>";

        while($datos = mysqli_fetch_array($res)){
            echo"
                        <tr>
                            <td>$datos[nombre_curos]</td>
                            <td>$datos[nombre_usr] $datos[apellido_m_usr] $datos[apellido_m_usr]</td>
                            <td>$datos[fecha_retiro]</td>
                        </tr>
                        ";
        }
        echo"
                    </tbody>
                </table>";

    }
    else{
        echo"|-1||";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>