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
            <h3>Observaciones del alumno</h3>
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td class="col-sm-4"><label>Profesor</label></td>
                    <td class="col-sm-6"><label>Observacion</label></td>
                    <td class="col-sm-2"><label>Fecha</label></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM observacion
                        INNER JOIN profesor ON profesor.id_profesor = observacion.id_profesor
                        INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                        INNER JOIN alumno ON alumno.id_alumno = observacion.id_alumno
                        INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                        WHERE alumno.rut_usr = '$_SESSION[rut_usr]' AND lista.anio = 2017";

                $res = $dbcon -> query($sql);

                while($datos = mysqli_fetch_array($res)){
                    echo"
                    <tr>
                        <td>$datos[nombre_usr] $datos[apellidpo_p_usr] $datos[apellidpo_m_usr]</td>
                        <td>$datos[observacion]</td>
                        <td>$datos[fecha_hora]</td>
                    </tr>
                    ";
                }

                ?>
                </tbody>
            </table>

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