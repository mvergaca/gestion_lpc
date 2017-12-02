<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $rut = $_POST["rut"];
    $curso = $_POST["curso"];
    $anio = $_POST["anio"];

    $sql = "SELECT * FROM lista
            INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
            INNER JOIN curso ON curso.id_curso = lista.id_curso
            WHERE usuario.rut_usr = '$rut' AND lista.anio = $anio";

    $res = $dbcon ->query($sql);

    $num = mysqli_num_rows($res);

    if($num > 0){
        while ($dat = mysqli_fetch_array($res)){
            $cur = $dat["nombre_curso"];
        }
        echo";-1;<h4><span class=\"label label-danger\">Alumno ya registrado en $cur</span></h4>;;";
    }
    else{
        if($num == 0){
            $sql2 = "SELECT * FROM alumno
                     INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                     WHERE usuario.rut_usr = '$rut'";

            $res2 = $dbcon->query($sql2);

            $num2 = mysqli_num_rows($res2);

            if($num2 > 0) {
                while ($dat2 = mysqli_fetch_array($res2)){
                    $id_alumno = $dat2["id_alumno"];
                    $nombre = $dat2["nombre_usr"];
                    $apellido_p = $dat2["apellido_p_usr"];
                    $apellido_m = $dat2["apellido_m_usr"];
                }

                $sql3 = "INSERT INTO lista(id_curso, id_alumno, anio) VALUES ($curso,$id_alumno,$anio)";
                $res3 = $dbcon->query($sql3);
                if(!$sql3) {
                    echo";-1;<h4><span class=\"label label - danger\">Error al insertar en la lista</span></h4>;;";
                }
                else{
                    echo ";1;$id_alumno;$nombre;$apellido_p;$apellido_m;";
                }
            }
            else{
                echo ";-1;<h4><span class=\"label label-danger\">Rut ingresado no es valido</span></h4>;;";
            }
        }

    }

    $res->close();
    include "cerrar_conexion.php";
}
?>