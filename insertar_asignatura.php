<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $nombre = $_POST["nombre"];

    $sql = "INSERT INTO asignatura (nombre_asignatura) VALUES ('$nombre')";

    $resu = $dbcon ->query($sql);

    if($resu){
        echo"|1|
        <table class=\"table table-bordered table-responsive\">
                <thead>
                <tr>
                    <td><label>N°</label></td>
                    <td><label>Nombre Asignatura</label></td>
                    <td><label>Editar</label></td>
                    <td><label>Eliminar</label></td>
                </tr>
                </thead>
                <tbody>";

                $sql = "SELECT * FROM asignatura ORDER BY nombre_asignatura";
                $res=$dbcon->query($sql);
                $i = 1;
                while ($datos = mysqli_fetch_array($res)){
                    echo"<tr>
                            <td>$i</td>
                            <td>$datos[nombre_asignatura]</td>
                            <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_asignatura($datos[id_asignatura], $i);'></td>
                            <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_asignatura($datos[id_asignatura], $i);'></td>
                         </tr>";
                    $i++;
                }
                echo"
                </tbody>
            </table>
        ||";
    }
    else{
        echo"|-1||";
    }
    $resu->close();
    include "cerrar_conexion.php";
}
?>