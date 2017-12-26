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
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <?php
            $sql = "SELECT * FROM asignatura
                    inner JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                    INNER JOIN curso ON curso.id_curso = clase.id_curso
                    INNER JOIN lista ON lista.id_curso = curso.id_curso
                    INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                    WHERE asignatura.id_asignatura = $_GET[asig] AND alumno.rut_usr = '$_SESSION[rut_usr]'";
            $res = $dbcon->query($sql);
            while ($datos = mysqli_fetch_array($res)){
                echo"<h3>$datos[nombre_asignatura] - $datos[nombre_curso]</h3>";
                $curso = $datos['id_curso'];
            }

            $sql2 = "SELECT * FROM mensaje 
                      INNER JOIN asignatura ON asignatura.id_asignatura = mensaje.id_asignatura
                      INNER JOIN curso ON curso.id_curso = mensaje.id_curso
                      WHERE asignatura.id_asignatura = $_GET[asig] AND curso.id_curso = $curso AND mensaje.fecha_mensaje >= CURRENT_DATE ()";
            $res2 = $dbcon->query($sql2);

            echo"
            <table class='table table-responsive table-bordered'>
            <thead>
            <tr>
                <td class='col-sm-2'><label>Fecha</label></td>
                <td class='col-sm-10'><label>Mensaje</label></td>
            </tr>
            </thead>
            <tbody>
            ";

            while($datos2 = mysqli_fetch_array($res2)){
                echo"
                <tr>
                    <td>$datos2[fecha_mensaje]</td>
                    <td>$datos2[mensaje]</td>
                </tr>
                ";
            }

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