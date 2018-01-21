<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $rut = $_POST['rut'];

    $con = "SELECT * FROM usuario
            INNER JOIN administrador ON administrador.rut_usr = usuario.rut_usr
            WHERE usuario.rut_usr = '$rut'";
    $rescon = $dbcon ->query($con);

    if(mysqli_num_rows($rescon) > 0){
        echo ";-1;";
    }
    else{
        $sql = "SELECT * FROM usuario
                LEFT JOIN alumno ON alumno.rut_usr = usuario.rut_usr
                LEFT JOIN apoderado ON apoderado.rut_usr = usuario.rut_usr
                LEFT JOIN asistente ON asistente.rut_usr = usuario.rut_usr
                LEFT JOIN director ON director.rut_usr = usuario.rut_usr
                LEFT JOIN inspector ON inspector.rut_usr = usuario.rut_usr
                LEFT JOIN profesor ON profesor.rut_usr = usuario.rut_usr
                LEFT JOIN secretaria ON secretaria.rut_usr = usuario.rut_usr
                LEFT JOIN utp ON utp.rut_usr = usuario.rut_usr
                WHERE usuario.rut_usr = '$rut'";
        $resu = $dbcon ->query($sql);

        while($datos = mysqli_fetch_array($resu)){
            $alumno = $datos['id_alumno'];
            $apoderado = $datos['id_apoderado'];
            $asistente = $datos['id_asistente'];
            $director = $datos['id_director'];
            $inspector = $datos['id_inspector'];
            $profesor = $datos['id_profesor'];
            $secretaria = $datos['id_secretaria'];
            $utp = $datos['id_utp'];

            $rut = $datos['rut_usr'];
        }

        if($alumno != null){
            $sql2 = "DELETE FROM alumno WHERE id_alumno = $alumno";
            $res2 = $dbcon->query($sql2);

            $sql3 = "INSERT INTO retirado(rut_usr, fecha_retiro, tipo_usuario) VALUES ('$rut',CURRENT_DATE(),'alumno')";
            $res3 = $dbcon->query($sql3);
        }

        if($apoderado != null){
            $sql2 = "DELETE FROM apoderado WHERE id_apoderado = $apoderado";
            $res2 = $dbcon->query($sql2);

            $sql3 = "INSERT INTO retirado(rut_usr, fecha_retiro, tipo_usuario) VALUES ('$rut',CURRENT_DATE(),'apoderado')";
            $res3 = $dbcon->query($sql3);
        }

        if($asistente != null){
            $sql2 = "DELETE FROM asistente WHERE id_asistente = $asistente";
            $res2 = $dbcon->query($sql2);

            $sql3 = "INSERT INTO retirado(rut_usr, fecha_retiro, tipo_usuario) VALUES ('$rut',CURRENT_DATE(),'asistente')";
            $res3 = $dbcon->query($sql3);
        }

        if($director != null){
            $sql2 = "DELETE FROM director WHERE id_director = $director";
            $res2 = $dbcon->query($sql2);

            $sql3 = "INSERT INTO retirado(rut_usr, fecha_retiro, tipo_usuario) VALUES ('$rut',CURRENT_DATE(),'director')";
            $res3 = $dbcon->query($sql3);
        }

        if($inspector != null){
            $sql2 = "DELETE FROM inspector WHERE id_inspector = $inspector";
            $res2 = $dbcon->query($sql2);

            $sql3 = "INSERT INTO retirado(rut_usr, fecha_retiro, tipo_usuario) VALUES ('$rut',CURRENT_DATE(),'inspector')";
            $res3 = $dbcon->query($sql3);
        }

        if($profesor != null){
            $sql2 = "DELETE FROM profesor WHERE id_profesor = $profesor";
            $res2 = $dbcon->query($sql2);

            $sql3 = "INSERT INTO retirado(rut_usr, fecha_retiro, tipo_usuario) VALUES ('$rut',CURRENT_DATE(),'profesor')";
            $res3 = $dbcon->query($sql3);
        }

        if($secretaria != null){
            $sql2 = "DELETE FROM secretaria WHERE id_secretaria = $secretaria";
            $res2 = $dbcon->query($sql2);

            $sql3 = "INSERT INTO retirado(rut_usr, fecha_retiro, tipo_usuario) VALUES ('$rut',CURRENT_DATE(),'secretaria')";
            $res3 = $dbcon->query($sql3);
        }

        if($utp != null){
            $sql2 = "DELETE FROM utp WHERE id_utp = $utp";
            $res2 = $dbcon->query($sql2);

            $sql3 = "INSERT INTO retirado(rut_usr, fecha_retiro, tipo_usuario) VALUES ('$rut',CURRENT_DATE(),'utp')";
            $res3 = $dbcon->query($sql3);
        }

        if(!$res2){
            echo ";-1;";
        }
        else{
            echo ";1;";
        }
        $resu->close();
        $res2->close();
        $res3->close();
    }

    $rescon ->close();


    include "cerrar_conexion.php";
}
?>