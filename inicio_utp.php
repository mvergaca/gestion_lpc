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
    <title>Inicio Utp</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_utp.php";
    ?>
</section>

<section id="principal">

    <?php
    $sql = "SELECT DISTINCT alumno.rut_usr, usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr,
                curso.id_curso, curso.nombre_curso, asistencia.fecha
                FROM asistencia 
                INNER JOIN alumno ON alumno.id_alumno = asistencia.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                INNER JOIN curso ON curso.id_curso = lista.id_curso
                WHERE asistencia.estado = 0 AND asistencia.justificacion = 0
                ORDER BY curso.id_curso, usuario.nombre_usr";

    $res = $dbcon->query($sql);
    if(mysqli_num_rows($res)>0) {
        echo "
    <div class='col-sm-offset-0 col-sm-12'>
        <div id='inasistencias' class='col-sm-offset-2 col-sm-8 alert-danger'>
            <h3>Inasistencias</h3>
            <table class='table table-bordered table-responsive'>
                <thead>
                <tr>
                    <td><label>Nombre</label></td>
                    <td><label>Curso</label></td>
                    <td><label>Fecha</label></td>
                </tr>
                </thead>
                <tbody>";

        while ($datos = mysqli_fetch_array($res)) {
            echo "<tr>
                <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                <td>$datos[nombre_curso]</td>
                <td>$datos[fecha]</td>
            </tr>";
        }

        echo"   </tbody>
            </table>
        </div>";
    }


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