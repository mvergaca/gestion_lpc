<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $curso = $_POST["curso"];
    $asignatura = $_POST["asigna"];


    $sql = "SELECT * FROM lista
                                INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                                WHERE lista.anio = YEAR(NOW()) AND lista.id_curso = $curso
                                ORDER BY usuario.nombre_usr";
    $res = $dbcon ->query($sql);

    $sql2 = "SELECT * FROM asignatura WHERE id_asignatura = $asignatura";
    $res2 = $dbcon->query($sql2);
    while($datos2 = mysqli_fetch_array($res2)){
        $nombre_asi = $datos2["nombre_asignatura"];
    }

    if($res){
        echo"|1|
        <h4>$nombre_asi</h4>
        <table class=\"table table-bordered table-responsive\">
                    <thead>
                    <tr>
                        <td class=\"col-sm-10\">Alumno</td>
                        <td class=\"col-sm-2\">Estado</td>
                    </tr>
                    </thead>
                    <tbody>";

                        while($datos = mysqli_fetch_array($res)){
                            echo"
                            <tr>
                            <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                            <td>";
                            $sql3 = "SELECT * FROM asistencia
                                    WHERE id_asignatura = $asignatura AND id_alumno = $datos[id_alumno] 
                                    AND fecha = CURRENT_DATE() order  by id_asistencia asc limit 1";
                            $res3 = $dbcon->query($sql3);
                            $estado = "";
                            if(mysqli_num_rows($res3) < 1){
                                echo"<span class=\"glyphicon glyphicon-minus\" aria-hidden=\"true\"></span>";
                            }
                            while($datos3 = mysqli_fetch_array($res3)){
                                if($datos3["estado"] == 0){
                                    echo"<span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>";
                                }
                                else{
                                    if($datos3["estado"] == 1){
                                        echo"<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
                                    }
                                }

                            }
                            echo"
                            </td>
                            </tr>
                            ";
                        }
                   echo"
                    </tbody>
                </table>
        |";
    }
    else{
        echo"|-1||";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>