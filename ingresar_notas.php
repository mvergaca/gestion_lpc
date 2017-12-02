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
    <div align="center">
    <?php
    $curso = $_GET['curso'];
    $asignatura = $_GET['asig'];
    echo"<input type='hidden' id='asig' value='$asignatura'>
         <input type='hidden' id='curso' value='$curso'>
         <label >Detalle</label><input type='text' id='detalle' class='form-control' style='width: auto'><br>";
    $sql = "SELECT * FROM alumno 
            INNER JOIN lista ON alumno.id_alumno = lista.id_alumno
            INNER JOIN curso ON lista.id_curso = curso.id_curso
            INNER JOIN usuario ON alumno.rut_usr=usuario.rut_usr
            WHERE curso.id_curso = $curso";
    $res = $dbcon->query($sql);

    echo"<table id='ingresar' class='table-bordered table-responsive' style='background-color: #f7ecb5;'>
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
         <input type='button' id='guardar_notas' class='btn btn-info' value='Guardar'>";
    ?>
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