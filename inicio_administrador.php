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
    <meta http-equiv="content-type" content="text/html">
    <title>Inicio Administrador</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>

<section id="encabezado">
    <?php
        include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <?php
    $sql = "SELECT DISTINCT alumno.rut_usr, usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr,
                curso.id_curso, curso.nombre_curso, asistencia.fecha_hora
                FROM asistencia 
                INNER JOIN alumno ON alumno.id_alumno = asistencia.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                INNER JOIN curso ON curso.id_curso = lista.id_curso
                WHERE asistencia.estado = 0 AND asistencia.justificacion = 0
                ORDER BY usuario.nombre_usr";

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
                <td>$datos[fecha_hora]</td>
            </tr>";
        }

        echo"   </tbody>
            </table>
        </div>
    </div>";
    }

    $sql2 = "SELECT * FROM reserva 
              INNER JOIN profesor ON profesor.id_profesor = reserva.id_profesor
              INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
              INNER JOIN sala ON sala.id_sala = reserva.id_sala
              WHERE fecha_reserva = CURRENT_DATE ();";
    $res2 = $dbcon->query($sql2);
    if(mysqli_num_rows($res2)>0){
        echo"
        <div id=\"reservas\" class=\"col-sm-offset-2 col-sm-8 alert-info\">
        <h3>Reservas del dia</h3>
            <table class='table table-bordered table-responsive'>
                <thead>
                <tr>
                    <td><label>Profesor</label></td>
                    <td><label>Sala</label></td>
                    <td><label>Inicio reserva</label></td>
                    <td><label>Fin reserva</label></td>
                </tr>
                </thead>
                <tbody>";

        while ($datos2 = mysqli_fetch_array($res2)) {
            echo "<tr>
                <td>$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]</td>
                <td>$datos2[nombre_sala]</td>
                <td>$datos2[inicio_reserva]</td>
                <td>$datos2[fin_reserva]</td>
            </tr>";
        }

        echo"   </tbody>
            </table>
        </div>
        ";
    }


    $sql3 = "SELECT * FROM caso_social";
    $res3 = $dbcon->query($sql3);
    if(mysqli_num_rows($res3)>0){
        echo"
        <div id=\"casos_sociales\" class=\"col-sm-offset-2 col-sm-8 alert-warning\">
        <h3>Casos sociales nuevos</h3>
            <table class='table table-bordered table-responsive'>
                <thead>
                
                </thead>
                <tbody>";

        while ($datos3 = mysqli_fetch_array($res3)) {
            echo "$datos3[id_caso_social]<br>";
        }

        echo"   </tbody>
            </table>
        </div>
        ";
    }

    ?>


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