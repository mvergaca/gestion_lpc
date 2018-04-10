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

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script type="text/javascript">
        function justificar(ref) {
            window.location.href="justificar_alumno.php?id="+ref;
        }
    </script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_inspector.php";
    ?>
</section>

<section id="principal">

    <?php
    $sql = "SELECT DISTINCT  alumno.id_alumno, alumno.rut_usr, usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr,
                curso.id_curso, curso.nombre_curso, asistencia.fecha
                FROM asistencia 
                INNER JOIN alumno ON alumno.id_alumno = asistencia.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                INNER JOIN curso ON curso.id_curso = lista.id_curso
                WHERE asistencia.estado = 1 AND asistencia.justificacion = 1
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
                    <td><label>Justificar</label></td>
                </tr>
                </thead>
                <tbody id='contenido'>";

        while ($datos = mysqli_fetch_array($res)) {
            echo "<tr>
                <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                <td>$datos[nombre_curso]</td>
                <td>$datos[fecha]</td>
                <td><input type='button' class='btn btn-danger' value='Justificar' onclick='justificar($datos[id_alumno]);'></td>
            </tr>";
        }

        echo"   </tbody>
            </table>
        </div>";
    }
    $sql3 = "SELECT * FROM usuario
              LEFT JOIN asistente ON asistente.rut_usr = usuario.rut_usr
              LEFT JOIN alumno ON alumno.rut_usr = usuario.rut_usr
              LEFT JOIN caso_social ON caso_social.id_alumno = alumno.id_alumno
              WHERE caso_social.estado = 1 
              ORDER BY caso_social.fecha, caso_social.hora";
    $res3 = $dbcon->query($sql3);
    if(mysqli_num_rows($res3)>0){
        echo"
        <div id=\"casos_sociales\" class=\"col-sm-offset-2 col-sm-8 alert-warning\">
        <h3>Casos sociales nuevos</h3>
            <table class='table table-bordered table-responsive'>
                <thead>
                <tr>
                    <td><label>Alumno</label></td>
                    <td><label>Fecha</label></td>
                </tr>
                </thead>
                <tbody>";

        while ($datos3 = mysqli_fetch_array($res3)) {
            echo "<tr>
                    <td>$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</td>
                    <td>$datos3[fecha]</td>
                </tr>";
        }

        echo"   </tbody>
            </table>
        </div>
        ";
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