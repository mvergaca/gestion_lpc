<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $nombre = $_POST["nombre"];
    $encargado = $_POST["encargado"];

    $sql = "INSERT INTO sala (nombre_sala, encargado) VALUES ('$nombre','$encargado')";

    $resu = $dbcon ->query($sql);

    if($resu){
        echo"|1|
        <table class=\"table table-bordered table-responsive\">
                <thead>
                <tr>
                    <td><label>N°</label></td>
                    <td><label>Nombre Sala</label></td>
                    <td><label>Encargado</label></td>
                    <td><label>Editar</label></td>
                    <td><label>Eliminar</label></td>
                </tr>
                </thead>
                <tbody>";

        $sql = "SELECT * FROM sala 
                LEFT JOIN usuario ON usuario.rut_usr = sala.encargado
                ORDER BY sala.nombre_sala";
        $res=$dbcon->query($sql);
        $i = 1;
        while ($datos = mysqli_fetch_array($res)){
            echo"<tr>
                            <td>$i</td>
                            <td>$datos[nombre_sala]</td>
                            <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
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