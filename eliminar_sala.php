<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $id = $_POST["id"];

    $sql = "DELETE FROM sala WHERE id_sala = $id";

    $resu = $dbcon ->query($sql);

    if($resu){
        echo"|1|
        <table class=\"table table-bordered table-responsive\">
                <thead>
                <tr>
                    <td><label>N°</label></td>
                    <td><label>Nombre Sala</label></td>
                    <td><label>Editar</label></td>
                    <td><label>Eliminar</label></td>
                </tr>
                </thead>
                <tbody>";

        $sql = "SELECT * FROM sala ORDER BY nombre_sala";
        $res=$dbcon->query($sql);
        $i = 1;
        while ($datos = mysqli_fetch_array($res)){
            echo"<tr>
                            <td>$i</td>
                            <td>$datos[nombre_sala]</td>
                            <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_sala($datos[id_sala]);'></td>
                            <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_sala($datos[id_sala]);'></td>
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