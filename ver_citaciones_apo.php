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
    <title>Inicio Apoderado</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_apoderado.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <?php
            $sql2 = "SELECT * FROM alumno
                     INNER JOIN usuario on usuario.rut_usr = alumno.rut_usr
                     where alumno.id_alumno = $_GET[id]";
            $res2 = $dbcon->query($sql2);
            while ($datos2 = mysqli_fetch_array($res2)){
                echo"<h4>$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]</h4>";
            }

            echo"<table class='table table-responsive table-bordered'>
                <thead>
                <tr>
                    <td class='col-sm-2'><label>Fecha</label></td>
                    <td class='col-sm-2'><label>Hora</label></td>
                    <td class='col-sm-8'><label>Motivo</label></td>
                </tr>
                </thead>
                <tbody>";
            $sql = "SELECT * FROM citacion 
                    where id_alumno = $_GET[id] and fecha >= CURRENT_DATE()";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"
                <tr>
                <td>$datos[fecha]</td>
                <td>$datos[hora]</td>
                <td>$datos[motivo]</td>
                </tr>
                ";
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