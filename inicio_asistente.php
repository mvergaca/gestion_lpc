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
        function obs_alumno(ref) {
            window.location.href = "obs_alumno_asi.php?id="+ref;
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
    <div class="col-sm-offset-2 col-sm-8">
        <?php
        $sql = "SELECT DISTINCT alumno.rut_usr, usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr,
                curso.id_curso, curso.nombre_curso, asistencia.fecha
                FROM asistencia 
                INNER JOIN alumno ON alumno.id_alumno = asistencia.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                INNER JOIN curso ON curso.id_curso = lista.id_curso
                WHERE asistencia.estado = 0 AND asistencia.justificacion = 0 AND lista.anio = YEAR(NOW())
                ORDER BY curso.id_curso, usuario.nombre_usr";

        $res = $dbcon->query($sql);
        if(mysqli_num_rows($res)>0) {
            echo "
    <div class='col-sm-offset-0 col-sm-12'>
        <div id='inasistencias' class=' alert-danger'>
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

        $sql2 = "SELECT * FROM observacion
                  INNER JOIN alumno ON alumno.id_alumno = observacion.id_alumno
                  INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                  WHERE observacion.fecha > DATE_SUB(CURDATE(), INTERVAL 7 DAY )";

        $res2 = $dbcon->query($sql2);

        if(mysqli_num_rows($res2)>0) {
            echo"
        <div id=\"observaciones\" class=\" alert-warning\">
        <h3>Observaciones de la semana</h3>
            <table class='table table-bordered table-responsive'>
                <thead>
                <tr>
                    <td><label>Alumno</label></td>
                    <td><label>Fecha</label></td>
                    <td><label>Ver</label></td>
                </tr>
                </thead>
                <tbody>";
            while ($datos2 = mysqli_fetch_array($res2)) {
                echo"
                <tr>
                    <td>$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]</td>
                    <td>$datos2[fecha]</td>
                    <td><input type='button' value='ver' class='btn btn-info' onclick='obs_alumno($datos2[id_alumno])'></td>    
                </tr>
                ";
            }
            echo"   </tbody>
            </table>
        </div>
        ";
        }

        $sql3 = "SELECT * FROM usuario
              LEFT JOIN asistente ON asistente.rut_usr = usuario.rut_usr
              LEFT JOIN alumno ON alumno.rut_usr = usuario.rut_usr
              LEFT JOIN caso_social ON caso_social.id_alumno = alumno.id_alumno
              WHERE caso_social.estado = 1 AND asistente.rut_usr = '$_SESSION[rut_usr]'
              ORDER BY caso_social.fecha, caso_social.hora";

        $res3 = $dbcon->query($sql3);

        if(mysqli_num_rows($res3)>0){
            echo"
        <div id=\"casos_sociales\" class=\" alert-info\">
        <h3>Casos sociales nuevos</h3>
            <table class='table table-bordered table-responsive'>
                <thead>
                <tr>
                    <td><label>Alumno</label></td>
                    <td><label>Fecha</label></td>
                    <td><label>Ver</label></td>
                </tr>
                </thead>
                <tbody>";

            while ($datos3 = mysqli_fetch_array($res3)) {
                echo "<tr>
                    <td>$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</td>
                    <td>$datos3[fecha]</td>
                    <td><input type='button' class='btn btn-info' value='Ver Caso' onclick='ver_caso($datos3[id_caso_social])'></td>
                </tr>";
            }

            echo"   </tbody>
            </table>
        </div>
        ";
        }
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