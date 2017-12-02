<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $rut = $_POST["rut"];
    $nombre = $_POST["nombre"];
    $apellido_p = $_POST["apellido_p"];
    $apellido_m = $_POST["apellido_m"];
    $fecha_n = $_POST["fecha_n"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];
    $comuna = $_POST["comuna"];
    $tipo_usuario = $_POST["tipo_usuario"];
    $genero = $_POST["genero"];

    $sql = "UPDATE usuario SET nombre_usr = '$nombre', apellido_p_usr = '$apellido_p', apellido_m_usr = '$apellido_m',
            fecha_n_usr = '$fecha_n', telefono_usr = '$telefono', correo_usr = '$correo', direccion_usr = '$direccion',
            comuna_usr = '$comuna', genero_usr = '$genero' 
            WHERE rut_usr = '$rut'";
    $res = $dbcon -> query($sql);

    if(!$res){
        echo";-1;;";
    }
    else{
        $sql2 = "SELECT * FROM usuario
                    LEFT JOIN administrador ON administrador.rut_usr = usuario.rut_usr
                    LEFT JOIN alumno ON alumno.rut_usr = usuario.rut_usr
                    LEFT JOIN apoderado ON apoderado.rut_usr = usuario.rut_usr
                    LEFT JOIN asistente ON asistente.rut_usr = usuario.rut_usr
                    LEFT JOIN director ON director.rut_usr = usuario.rut_usr
                    LEFT JOIN profesor ON profesor.rut_usr =usuario.rut_usr
                    LEFT JOIN secretaria ON secretaria.rut_usr = usuario.rut_usr
                    LEFT JOIN utp ON utp.rut_usr = usuario.rut_usr
                    WHERE usuario.rut_usr = '$rut'";

        $res2 = $dbcon -> query($sql2);

        while($datos = mysqli_fetch_array($res2)) {


            if (strcmp($tipo_usuario, 'administrador') != 0 && $datos['id_administrador'] != null) {
                $sql3 = "DELETE FROM administrador WHERE rut_usr = '$rut'";
                $res3 = $dbcon -> query($sql3);


                $sql4 = "INSERT INTO $tipo_usuario (rut_usr) VALUES ('$rut');";
                $res4 = $dbcon -> query($sql4);

            }
            if (strcmp($tipo_usuario, 'alumno') != 0 && $datos['id_alumno'] != null) {
                $sql3 = "DELETE FROM alumno WHERE rut_usr = '$rut'";
                $res3 = $dbcon -> query($sql3);


                $sql4 = "INSERT INTO $tipo_usuario (rut_usr) VALUES ('$rut');";
                $res4 = $dbcon -> query($sql4);

            }
            if (strcmp($tipo_usuario, 'apoderado') != 0 && $datos['id_apoderado'] != null) {
                $sql3 = "DELETE FROM apoderado WHERE rut_usr = '$rut'";
                $res3 = $dbcon -> query($sql3);


                $sql4 = "INSERT INTO $tipo_usuario (rut_usr) VALUES ('$rut');";
                $res4 = $dbcon -> query($sql4);

            }
            if (strcmp($tipo_usuario, 'asistente') != 0 && $datos['id_asistente'] != null) {
                $sql3 = "DELETE FROM asistente WHERE rut_usr = '$rut'";
                $res3 = $dbcon -> query($sql3);


                $sql4 = "INSERT INTO $tipo_usuario (rut_usr) VALUES ('$rut');";
                $res4 = $dbcon -> query($sql4);

            }
            if (strcmp($tipo_usuario, 'director') != 0 && $datos['id_director'] != null) {
                $sql3 = "DELETE FROM director WHERE rut_usr = '$rut'";
                $res3 = $dbcon -> query($sql3);


                $sql4 = "INSERT INTO $tipo_usuario (rut_usr) VALUES ('$rut');";
                $res4 = $dbcon -> query($sql4);

            }
            if (strcmp($tipo_usuario, 'profesor') != 0 && $datos['id_profesor'] != null) {
                $sql3 = "DELETE FROM profesor WHERE rut_usr = '$rut'";
                $res3 = $dbcon -> query($sql3);


                $sql4 = "INSERT INTO $tipo_usuario (rut_usr) VALUES ('$rut');";
                $res4 = $dbcon -> query($sql4);

            }
            if (strcmp($tipo_usuario, 'secretaria') != 0 && $datos['id_secretaria'] != null) {
                $sql3 = "DELETE FROM secretaria WHERE rut_usr = '$rut'";
                $res3 = $dbcon -> query($sql3);


                $sql4 = "INSERT INTO $tipo_usuario (rut_usr) VALUES ('$rut');";
                $res4 = $dbcon -> query($sql4);

            }
            if (strcmp($tipo_usuario, 'utp') != 0 && $datos['id_utp'] != null) {
                $sql3 = "DELETE FROM utp WHERE rut_usr = '$rut'";
                $res3 = $dbcon -> query($sql3);


                $sql4 = "INSERT INTO $tipo_usuario (rut_usr) VALUES ('$rut');";
                $res4 = $dbcon -> query($sql4);

            }


        }



        if(!$res2) {
            echo ";-1;;";
        }
        else{
            echo";1;;";
        }
    }
    $res->close();
    $res2 ->close();
    $res3->close();
    $res4->close();
    include "cerrar_conexion.php";
}
?>