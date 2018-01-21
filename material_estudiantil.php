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
    <title>Inicio Alumno</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

</head>
<body>

<section id="encabezado">
    <?php
    include "head_alumno.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div id="horario" class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <?php
            $sql = "SELECT * FROM asignatura WHERE id_asignatura = $_GET[asig]";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"<h3>Material estudio $datos[nombre_asignatura]</h3>";
            }

            $sql2 = "SELECT * FROM material_estudiantil
                      INNER JOIN clase ON clase.id_clase = material_estudiantil.id_clase
                      INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                      INNER JOIN curso ON curso.id_curso = clase.id_curso
                      INNER JOIN lista ON lista.id_curso = curso.id_curso
                      INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                      WHERE asignatura.id_asignatura = $_GET[asig] AND alumno.rut_usr = '$_SESSION[rut_usr]'
                      ";

            $res2 = $dbcon->query($sql2);
            echo"
            <table class='table table-bordered table-responsive'>
                <thead>
                <tr>
                    <td><label>Fecha</label></td>
                    <td><label>Detalle</label></td>
                    <td><label>Descargar</label></td>
                </tr>
            </thead>
            <tbody>
            ";
            while($datos2 = mysqli_fetch_array($res2)){
                echo"
                <tr>
                    <td>$datos2[fecha]</td>
                    <td>$datos2[detalle]</td>
                    <td><a href='descargar_archivo.php?ref=$datos2[dir_material]'><button class='btn btn-info'>Descargar</button></a></td>
                </tr>
                ";
            }
            $res2->close();
            echo"
            </tbody>
            </table>
            ";
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