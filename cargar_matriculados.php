<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $anio = $_POST["anio"];

    $sql = "SELECT * FROM alumno 
                            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                            INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                            INNER JOIN curso ON curso.id_curso = lista.id_curso
                            LEFT JOIN retirado ON retirado.rut_usr = alumno.rut_usr
                            WHERE lista.anio = $anio AND retirado.rut_usr IS NULL";

    $res = $dbcon ->query($sql);

    if(mysqli_num_rows($res) > 0){
        echo"|1|";

        echo"
        <table class=\"table table-bordered table-responsive\">
                    <thead>
                    <tr>
                        <td class=\"col-sm-1\"><label>N°</label></td>
                        <td class=\"col-sm-3\"><label>Curso</label></td>
                        <td class=\"col-sm-6\"><label>Nombre</label></td>
                        <td class=\"col-sm-2\"><label>Año</label></td>
                    </tr>
                    </thead>
                    <tbody>";
        $num = 1;
        while($datos = mysqli_fetch_array($res)){
            echo"
                        <tr>
                            <td>$num</td>
                            <td>$datos[nombre_curso]</td>
                            <td>$datos[nombre_usr] $datos[apellido_m_usr] $datos[apellido_m_usr]</td>
                            <td>$datos[anio]</td>
                        </tr>
                        ";
            $num++;
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