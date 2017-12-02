<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $id = $_POST["ref"];
    $sala = $_POST["sala"];

    $sql = "DELETE FROM reserva WHERE id_reserva = $id";

    $resu = $dbcon ->query($sql);

    if($resu){
        echo"|1|
        <table class=\"table table-bordered table-responsive\">
                    <thead>
                    <tr>
                        <td><label>N°</label></td>
                        <td><label>Profesor</label></td>
                        <td><label>Fecha</label></td>
                        <td><label>Horario</label></td>
                        <td><label>Editar</label></td>
                        <td><label>Eliminar</label></td>
                    </tr>
                    </thead>
                    <tbody>";

                    $sql3 = "SELECT * FROM reserva 
                            INNER JOIN profesor ON profesor.id_profesor = reserva.id_profesor
                            INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                            INNER JOIN sala ON sala.id_sala = reserva.id_sala
                            WHERE (fecha_reserva >= CURRENT_DATE ()) AND sala.id_sala = $sala
                            ORDER BY fecha_reserva, inicio_reserva";

                    $res3=$dbcon->query($sql3);
                    $i = 1;
                    while ($datos3 = mysqli_fetch_array($res3)){
                        echo"<tr>
                            <td>$i</td>
                            <td>$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</td>
                            <td>$datos3[fecha_reserva]</td>
                            <td>$datos3[inicio_reserva] - $datos3[fin_reserva]</td>
                            <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_reserva($datos3[id_reserva]);'></td>
                            <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_reserva($datos3[id_reserva]);'></td>
                         </tr>";
                        $i++;
                    }
                    $res3->close();
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