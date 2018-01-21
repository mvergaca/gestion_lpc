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
    <title>Inicio Asistente</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_asistente.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <?php
            $sql = "SELECT * FROM usuario
                    INNER JOIN alumno ON alumno.rut_usr = usuario.rut_usr
                    WHERE alumno.id_alumno = $_GET[id]";
            $res = $dbcon->query($sql);
            while ($datos = mysqli_fetch_array($res)){
                echo"<h4>Observaciones de $datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</h4>";
            }
            $res->close();

            $anio = date("Y");
            $fecha = $anio."-01-01";

            $sql2 = "SELECT * FROM observacion
                      INNER JOIN alumno ON alumno.id_alumno = observacion.id_alumno
                      WHERE alumno.id_alumno = $_GET[id] AND observacion.fecha >= '$fecha'";
            $res2 = $dbcon->query($sql2);

            echo"<table class='table table-bordered table-responsive'>
                <thead>
                <tr>
                    <td class='col-sm-9'><label>Observacion</label></td>
                    <td class='col-sm-3'><label>Fecha</label></td>
                </tr>
                </thead>
                <tbody>";

            while($datos2 = mysqli_fetch_array($res2)){
                echo"<tr>
                    <td>$datos2[observacion]</td>
                    <td>$datos2[fecha]</td>
                </tr>";
            }
            echo"</tbody>
            </table>";

            ?>

        </div>
    </div>
</section>

<section id="pie">
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