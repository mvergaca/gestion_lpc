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
            WHERE curso.id_curso = $curso ORDER BY usuario.nombre_usr";
    $res = $dbcon -> query($sql);

    $sql4 = "SELECT * FROM curso WHERE id_curso = $curso";
    $res4 = $dbcon->query($sql4);
    while($datos4 = mysqli_fetch_array($res4)){
        $nombre_curso = $datos4["nombre_curso"];
    }

    $sql2 = "SELECT * FROM semestre WHERE inicio_semestre < CURRENT_DATE () AND fin_semestre > CURRENT_DATE ";
    $res2 = $dbcon->query($sql2);
    while ($datos2 = mysqli_fetch_array($res2)){
        $nombre_semestre = $datos2["nombre_sem"];
        $id_semestre = $datos2["id_semestre"];
    }

    $sql3 = "SELECT * FROM asignatura WHERE id_asignatura = $asigna";
    $res3 = $dbcon->query($sql3);
    while($datos3 = mysqli_fetch_array($res3)){
        $nombre_asig = $datos3["nombre_asignatura"];
    }

    if(!$res){
        echo"|-1||";
    }else{
        echo"|1|
        
        <input type='hidden' id='asig' value='$asigna'>
         <input type='hidden' id='curso' value='$curso'>
         <input type='hidden' id='semestre' value='$id_semestre'>
         <h3>$nombre_asig $nombre_curso $nombre_semestre</h3>
         <div class='col-sm-offset-0 col-sm-12'>
            <div class='col-sm-offset-3 col-sm-2'>
                <label>Detalle</label>
            </div>
            <div class='col-sm-3'>
                <input type='text' id='detalle' class='form-control' style='width: auto'><br>
            </div>
        </div>
        <table id='ingresar' class='table table-bordered table-responsive'>
            <thead>
                <tr>
                    <td align='center'><label>Alumno</label></td>
                    <td align='center'><label>Nota</label></td>
                </tr>
            </thead>";

    $i = 1;
            while ($datos = mysqli_fetch_array($res)){
                echo"
                    <tr>
                    <input type='hidden' id='est_$i' value='$datos[id_alumno]'>
                        <td align='center'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                        <td align='center'><input name='nota' type='number' step='0.1' min='1.0' max='7.0' id='nota_$i' value='1' style='width: auto'></td>
                    </tr>
                ";
                $i++;
            }
    echo"</table>
         <input type='button' id='guardar_notas' class='btn btn-info' value='Guardar' onclick='guardar_notas();'>
    
        
        |";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>