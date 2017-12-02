<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $sala = $_POST["sala"];
    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"];

    $sql = "SELECT * FROM reserva
            INNER JOIN profesor ON profesor.id_profesor = reserva.id_profesor
            INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
            WHERE reserva.id_sala = $sala AND reserva.fecha_reserva >= '$desde' AND reserva.fecha_reserva <= '$hasta'
            ORDER BY reserva.fecha_reserva";

    $res = $dbcon->query($sql);

    if($res){
        echo"|1|<table class=\"table table-bordered table-responsive\">
                    <thead>
                    <tr >
                        <td style='width: 5%; border: #34a9b6 2px solid;'><label>N°</label></td>
                        <td style='width: 50%; border: #34a9b6 2px solid;'><label>Profesor</label></td>
                        <td style='width: 20%; border: #34a9b6 2px solid;'><label>Fecha</label></td>
                        <td style='width: 25%; border: #34a9b6 2px solid;'><label>Horario</label></td>
                    </tr>
                    </thead>
                    <tbody>";
                    $i = 1;
                        while ($datos = mysqli_fetch_array($res)){
                            echo"
                            <tr>
                                <td style='border: #34a9b6 2px solid;'>$i</td>
                                <td style='border: #34a9b6 2px solid;'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                                <td style='border: #34a9b6 2px solid;'>$datos[fecha_reserva]</td>
                                <td style='border: #34a9b6 2px solid;'>$datos[inicio_reserva] - $datos[fin_reserva]</td>
                            </tr>
                            ";
                            $i++;
                        }

                    echo"
                    </tbody>
                </table>|";
    }
    else{
        echo"|-1||";
    }
    $res->close();
    include "cerrar_conexion.php";
}
?>