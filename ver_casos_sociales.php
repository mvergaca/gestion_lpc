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

    <script>
        function ver_caso(ref) {
            window.location.href = "editar_caso_social.php?id="+ref;
        }
    </script>
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
            <h3>Casos sociales pendientes</h3>
            <table class="table table-responsive table-bordered">
                <thead>
                <tr>
                    <td><label>Alumno</label></td>
                    <td><label>Descripcion</label></td>
                    <td><label>Fecha</label></td>
                    <td><label>Ver</label></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $anio = DATE("Y");
                $fecha = $anio."-01-01";

                $sql = "SELECT * FROM caso_social
                        INNER JOIN alumno ON alumno.id_alumno = caso_social.id_alumno
                        INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                        INNER JOIN asistente ON asistente.id_asistente = caso_social.id_asistente
                        WHERE asistente.rut_usr = '$_SESSION[rut_usr]' AND caso_social.estado = 1
                        AND caso_social.fecha >= '$fecha'";
                $res = $dbcon->query($sql);

                while($datos = mysqli_fetch_array($res)){
                    echo"
                    <tr>
                        <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                        <td>$datos[descripcion_caso]</td>
                        <td>$datos[fecha]</td>
                        <td><input type='button' value='Ver' class='btn btn-info' onclick='ver_caso($datos[id_caso_social])'></td>
                    </tr>
                    ";
                }

                echo"</tbody>
                </table>";

                ?>
                </tbody>
            </table>
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