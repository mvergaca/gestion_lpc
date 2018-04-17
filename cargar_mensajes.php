<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"];
    $curso = $_POST["curso"];
    $asigna = $_POST["asigna"];

    $sql = "SELECT * FROM mensaje
            where id_curso = $curso and id_asignatura = $asigna and fecha_mensaje >= '$desde' and fecha_mensaje <= '$hasta'";
    $res = $dbcon->query($sql);

    if(mysqli_num_rows($res) > 0){
        echo"|1|
        <table class='table table-bordered table-responsive'>
        <thead>
        <tr>
                        <td class=\"col-sm-3\"><label>Fecha</label></td>
                        <td class=\"col-sm-9\"><label>Mensaje</label></td>
        </tr>
        </thead>
        <tbody>";
        while($datos = mysqli_fetch_array($res)){
            echo"
                        <tr>
                            <td>$datos[fecha_mensaje]</td>
                            <td>$datos[mensaje]</td>   
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