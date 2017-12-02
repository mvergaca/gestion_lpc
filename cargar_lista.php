<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $anio = $_POST["anio"];
    $curso = $_POST["curso"];

    $sql = "SELECT * FROM lista
            INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
            INNER JOIN curso ON curso.id_curso = lista.id_curso
            WHERE curso.id_curso = $curso AND lista.anio = $anio";

    $res = $dbcon ->query($sql);
$num = mysqli_num_rows($res);
$i = 1;
    if($num > 0){
        echo"|1|";
        while($datos = mysqli_fetch_array($res)){
            echo"
            <tr id='fila_$i'>
                <td id='col_.$i._1'>
                <input type='text' id='rut_$i' class='form-control' placeholder='Rut' value='$datos[rut_usr]' disabled>
                </td>
                <td id='col_.$i._2'>
                    <input type='hidden' id='est_$i' value='$datos[id_alumno]'>
                    $datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr] 
                </td>
                <td id='col_.$i._3'>
                    <input type='button' name='agregar' id='agregar_$i' class='btn btn-success' value='Agregar' onclick='agregar_alumno($i);'>
                    <input type='button' name='quitar' id='quitar_$i' class='btn btn-danger' value='Quitar' onclick='quitar_alumno($i);'>
                </td>
            </tr>
            ";

            $i++;
        }
        echo"||";
    }
    else{
        echo"|-1||";
    }
    $res->close();
    include "cerrar_conexion.php";
}
?>