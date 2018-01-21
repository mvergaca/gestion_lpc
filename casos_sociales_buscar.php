<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"];

    $sql = "SELECT * FROM caso_social
            WHERE fecha >= '$desde' AND fecha <= '$hasta'
            ORDER BY fecha";

    $res = $dbcon->query($sql);

    if(!$res){
        echo"|-1|$sql|";
    }
    else{
        echo"|1|";
        $i=1;
        while($datos = mysqli_fetch_array($res)){
            echo"
            <tr>
                <td>$i</td>
                <td>"; $sql2 = "SELECT * FROM asistente
                                INNER JOIN usuario ON usuario.rut_usr = asistente.rut_usr
                                WHERE asistente.id_asistente = $datos[id_asistente]";
                        $res2 = $dbcon->query($sql2);
                        while($datos2 = mysqli_fetch_array($res2)){
                            echo"$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]";
                        }
                        $res2->close();
                echo"</td>


                <td>"; $sql3 = "SELECT * FROM alumno
                                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                                WHERE alumno.id_alumno = $datos[id_alumno]";
                        $res3 = $dbcon->query($sql3);
                        while($datos3 = mysqli_fetch_array($res3)){
                            echo"$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]";
                        }
                        $res3->close();
                echo"</td>


                <td>$datos[fecha]</td>
                <td><input type='button' class='btn btn-info' value='ver' onclick='ver_caso($datos[id_caso_social])'></td>
            </tr>
            ";
                $i++;
        }

        echo"|";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>