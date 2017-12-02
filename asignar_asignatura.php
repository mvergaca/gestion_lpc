<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $curso = $_POST["curso"];
    $asignatura = $_POST["asignatura"];
    $profesor = $_POST["profesor"];
    $anio = $_POST["anio"];

$con = "SELECT * FROM clase WHERE id_curso = $curso AND id_asignatura = $asignatura AND id_profesor = $profesor AND anio = $anio";
$res = $dbcon->query($con);
if(mysqli_num_rows($res) > 0){
    echo"|-1|Profesor ya registrado en este curso con esa asignatura|";
}
else {
    $sql = "INSERT INTO clase(id_curso, id_asignatura, id_profesor, anio) VALUES ($curso, $asignatura, $profesor, $anio)";
    $res = $dbcon->query($sql);

    if (!$res) {
        echo "|-1|No se pudo crear la clase|";
    } else {

        echo "|1|

        <table class=\"table table-responsive table-bordered\" style=\"background-color: #f7ecb5;\">
            <thead>
            <tr>
                <th>Asignatura</th>
                <th>Profesor</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody> ";


        $sql4 = "SELECT * FROM asignatura
                    INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                    INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                    INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                    WHERE clase.id_curso = $curso AND anio = $anio";
        $res4 = $dbcon->query($sql4);
        $i = 1;
        while ($datos4 = mysqli_fetch_array($res4)) {
            echo "<tr id='fila_$i'>
                        <td>$datos4[nombre_asignatura]</td>
                        <td>$datos4[nombre_usr] $datos4[apellido_p_usr] $datos4[apellido_m_usr]</td>
                        <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_clase($datos4[id_clase]);'></td>
                        <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_clase($datos4[id_clase],$i);'></td>
                    </tr>";
            $i++;
        }
        echo "
            </tbody>
        </table>";

        echo "||";

    }
}
    $res->close();
    include "cerrar_conexion.php";
}
?>