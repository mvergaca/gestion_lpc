<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $alumno = $_POST["alumno"];
    $curso = $_POST["curso"];


    $sql = "SELECT * FROM graduado WHERE id_alumno = $alumno";
    $res = $dbcon -> query($sql);

    if(mysqli_num_rows($res) < 1){

        $sql2 = "SELECT * FROM lista 
                inner join curso on curso.id_curso = lista.id_curso 
                where lista.anio = YEAR(NOW())+1 and lista.id_alumno = $alumno";
        $res2 = $dbcon->query($sql2);

        if(mysqli_num_rows($res2) < 1){

            $sql3 = "SELECT * FROM lista
                    INNER JOIN curso on curso.id_curso = lista.id_curso
                    where lista.anio = YEAR(NOW()) and lista.id_alumno = $alumno";
            $res3 = $dbcon->query($sql3);

            while($datos3 = mysqli_fetch_array($res3)){
                $cur_actual = $datos3['id_curso'];
            }

            if($curso == 100){
                $sql5 = "INSERT INTO graduado(id_alumno, anio_graduacion) 
                          VALUES ($alumno,YEAR(NOW()))";
                $res5 = $dbcon->query($sql5);

                if($res5){
                    echo";1;;";
                }
                else{
                    echo";-1;No se pudo gradiar el alumno;";
                }
            }
            else {

                if ($curso != $cur_actual) {

                    $sql4 = "INSERT INTO lista (id_curso, id_alumno, anio)
                        values ($curso,$alumno,YEAR(NOW())+1)";
                    $res4 = $dbcon->query($sql4);

                    if ($res4) {
                        echo ";1;;";
                    } else {
                        echo ";-1;No se pudo aprobar el alumno;";
                    }

                } else {
                    echo ";-1;Debe ingresar un curso mayor para aprobar a los alumnos;";
                }
            }

        }
        else{
            while ($datos2 = mysqli_fetch_array($res2)){
                $nombre_curso = $datos2['nombre_curso'];
                $anio = $datos2['anio'];
            }
            $res2->close();
            echo";-1;Alumno ya se encuentra en la lista de $nombre_curso año $anio;";
        }

    }
    else{
        echo";-1;Alumno ya esta graduado;";
    }


    $res->close();
    include "cerrar_conexion.php";
}
?>