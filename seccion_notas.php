<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $curso = $_POST["curso"];
    $asigna = $_POST["asigna"];



    $sql = "SELECT * FROM alumno 
            INNER JOIN lista ON alumno.id_alumno = lista.id_alumno
            INNER JOIN curso ON lista.id_curso = curso.id_curso
            INNER JOIN usuario ON alumno.rut_usr=usuario.rut_usr
            WHERE curso.id_curso = $curso";
    $res = $dbcon -> query($sql);

    if(!$res){
        echo"|-1||";
    }else{
        echo"|1|
        
        <input type='hidden' id='asig' value='$asigna'>
         <input type='hidden' id='curso' value='$curso'>
         <label >Detalle</label><input type='text' id='detalle' class='form-control' style='width: auto'><br>\";
    

        <table id='ingresar' class='table-bordered table-responsive' style='background-color: #f7ecb5;'>
            <thead>
                <tr>
                    <td align='center'><b>Alumno</b></td>
                    <td align='center'><b>Nota</b></td>
                </tr>
            </thead>";

    $i = 1;
            while ($datos = mysqli_fetch_array($res)){
                echo"
                    <tr>
                    <input type='hidden' id='est_$i' value='$datos[id_alumno]'>
                        <td align='center'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                        <td align='center'><input name='nota' type='number' min='1' max='7' id='nota_$i' value='1' style='width: auto'></td>
                    </tr>
                ";
                $i++;
            }
    echo"</table><br><br>
         <input type='button' id='guardar_notas' class='btn btn-info' value='Guardar' onclick='guardar_notas();'>
    
        
        |";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>