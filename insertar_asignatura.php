<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $nombre = $_POST["nombre"];
    $promediable = $_POST["promediable"];

    $sql = "INSERT INTO asignatura (nombre_asignatura, promediable) VALUES ('$nombre',$promediable)";

    $resu = $dbcon ->query($sql);

    if($resu){
        echo"|1|
        <table class=\"table table-bordered table-responsive\">
                <thead>
                <tr>
                    <td class='col-sm-1'><label>N°</label></td>
                    <td class='col-sm-6'><label>Nombre Asignatura</label></td>
                    <td class='col-sm-1'><label>Promediable</label></td>
                    <td class='col-sm-2'><label>Editar</label></td>
                    <td class='col-sm-2'><label>Eliminar</label></td>
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
                            <td>";if($datos['promediable'] == 1){echo"Si";}else{echo"No";}echo"</td>
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
        echo"|-1|$sql|";
    }
    $resu->close();
    include "cerrar_conexion.php";
}
?>