<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $semestre = $_POST["semestre"];
    $inicio = $_POST["inicio"];
    $fin = $_POST["fin"];

    $año = date('Y');

    $sql = "SELECT * FROM semestre WHERE anio = $año";
    $res = $dbcon -> query($sql);

    if(mysqli_num_rows($res) < 2){

        $sql2 = "INSERT INTO semestre (inicio_semestre, fin_semestre, anio, nombre_sem) VALUES ('$inicio','$fin',$año, '$semestre')";
        $res2 = $dbcon->query($sql2);

        if($res2){
            echo"|1|
                
                <table class=\"table table-bordered table-responsive\">
                    <thead>
                    <tr>
                        <td><label>Nombre Semestre</label></td>
                        <td><label>Inicio Semestre</label></td>
                        <td><label>Fin Semestre</label></td>
                        <td><label>Editar</label></td>
                        <td><label>Eliminar</label></td>
                    </tr>
                    </thead>
                <tbody>";

                $sql3 = "SELECT * from semestre WHERE anio = $año";
                $res3 = $dbcon->query($sql3);
                $i = 1;
                while ($datos3 = mysqli_fetch_array($res3)){
                    echo"
                    <tr id='fila_$i'>
                        <td>$datos3[nombre_sem] $datos3[anio]</td>
                        <td>$datos3[inicio_semestre]</td>
                        <td>$datos3[fin_semestre]</td>
                        <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_semestre($datos3[id_semestre]);'></td>
                        <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_semestre($datos3[id_semestre],$i);'></td>
                    </tr>
                    ";
                    $i++;
                }
                echo"
                </tbody>
                </table>
                
            |";
        }
        else{
            echo"|-1|$sql2|";
        }

    }else{
        echo"|-1|Solo se pueden tener 2 semestres en un año|";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>