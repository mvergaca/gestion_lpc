<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si"){
include "conexion.php";
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio Profesor</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <script src="js/ingresar_notas.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_profesor.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
    <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
    <?php
    $curso = $_GET['curso'];
    $asigna = $_GET['asig'];

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

    $sql4 = "SELECT * FROM curso WHERE id_curso = $curso";
    $res4 = $dbcon->query($sql4);
    while($datos4 = mysqli_fetch_array($res4)){
        $nombre_curso = $datos4["nombre_curso"];
    }

    echo"<input type='hidden' id='asig' value='$asigna'>
         <input type='hidden' id='curso' value='$curso'>
         <input type='hidden' id='semestre' value='$id_semestre'> 
         
         <h3>$nombre_asig - $nombre_curso - $nombre_semestre</h3>
         <div class='col-sm-offset-0 col-sm-12' style='margin: 2%'>
            <label class='col-sm-offset-4 col-sm-1'>Detalle</label>
            <div class='col-sm-3'>
               <input type='text' id='detalle' class='form-control'>
            </div>
         </div>";
    $sql = "SELECT * FROM alumno 
            INNER JOIN lista ON alumno.id_alumno = lista.id_alumno
            INNER JOIN curso ON lista.id_curso = curso.id_curso
            INNER JOIN usuario ON alumno.rut_usr=usuario.rut_usr
            WHERE curso.id_curso = $curso";
    $res = $dbcon->query($sql);

    echo"<table id='ingresar' class='table table-bordered table-responsive'>
            <thead>
                <tr>
                    <td align='center' style='border: #34a9b6 2px solid;'><b>Alumno</b></td>
                    <td align='center' style='border: #34a9b6 2px solid;'><b>Nota</b></td>
                </tr>
            </thead>";
    $i = 1;
            while ($datos = mysqli_fetch_array($res)){
                echo"
                    <tr>
                    <input type='hidden' id='est_$i' value='$datos[id_alumno]'>
                        <td align='center' style='border: #34a9b6 2px solid;'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                        <td align='center' style='border: #34a9b6 2px solid;'><input name='nota' type='number' min='1' max='7' id='nota_$i' value='1' style='width: auto'></td>
                    </tr>
                ";
                $i++;
            }
    echo"</table>
    <div class='col-sm-offset-0 col-sm-12' style='margin: 2%'>
         <input type='button' id='guardar_notas' class='btn btn-info' value='Guardar'>
    </div>";

    ?>
    </div>
    </div>
</section>

<section id="pie" class="col-sm-offset-0 col-sm-12">
    <?php
    include "footer.php";
    ?>
</section>
<?php
}else{
    header ("Location: index.php");
}
?>
</body>
</html>