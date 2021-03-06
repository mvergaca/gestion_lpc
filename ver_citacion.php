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
    <title>Inicio Inspector</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">


</head>
<body>

<section id="encabezado">
    <?php
    include "head_inspector.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>

            <h3>Ver citacion</h3>
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td class="col-sm-4"><label>Alumno</label></td>
                    <td class="col-sm-2"><label>Fecha</label></td>
                    <td class="col-sm-2"><label>Hora</label></td>
                    <td class="col-sm-4"><label>Motivo</label></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM citacion
                        inner join alumno on alumno.id_alumno = citacion.id_alumno
                        inner join usuario on usuario.rut_usr = alumno.rut_usr
                        where id_citacion = $_GET[id]";
                $res = $dbcon->query($sql);

                while($datos = mysqli_fetch_array($res)){
                    echo"
                    <tr>
                        <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                        <td>$datos[fecha]</td>
                        <td>$datos[hora]</td>
                        <td>$datos[motivo]</td>
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