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

    <script type="text/javascript">
        function cambiar(ref) {
            var rut = $("#rut_"+ref).val();
            window.location.href = "cambiar_con_adm.php?rut="+rut;
        }
    </script>
</head>
<body>

<section id="encabezado">
    <?php
        include "head_administrador.php";
    ?>
</section>

<section id="principal">

    <div class='col-sm-offset-0 col-sm-12'>
        <?php
        $sql4 = "SELECT DISTINCT usuario.rut_usr, usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr,
                            administrador.id_administrador, alumno.id_alumno, apoderado.id_apoderado,asistente.id_asistente,
                            director.id_director, inspector.id_inspector, profesor.id_profesor, secretaria.id_secretaria,utp.id_utp FROM recupera
                            INNER JOIN usuario ON usuario.rut_usr = recupera.rut_usr
                            LEFT JOIN administrador ON administrador.rut_usr = recupera.rut_usr
                            LEFT JOIN alumno ON alumno.rut_usr = recupera.rut_usr
                            LEFT JOIN apoderado ON apoderado.rut_usr = recupera.rut_usr
                            LEFT JOIN asistente ON asistente.rut_usr = recupera.rut_usr
                            LEFT JOIN director ON director.rut_usr = recupera.rut_usr
                            LEFT JOIN inspector ON inspector.rut_usr = recupera.rut_usr
                            LEFT JOIN profesor ON profesor.rut_usr = recupera.rut_usr
                            LEFT JOIN secretaria ON secretaria.rut_usr = recupera.rut_usr
                            LEFT JOIN utp ON utp.rut_usr = recupera.rut_usr
                            WHERE recupera.estado = 1 ORDER BY nombre_usr";

        $res4 = $dbcon -> query($sql4);
        if(mysqli_num_rows($res4) > 0) {
            echo "
        <div class='col-sm-offset-2 col-sm-8 alert-success'>
            <h3>Solicitudes de recuperacion de contraseña</h3>
            <table class='table table-responsive table-bordered'>
                <thead>
                <tr>
                    <td class='col-sm-7'><label>Nombre</label></td>
                    <td class='col-sm-3'><label>Tipo usuario</label></td>
                    <td class='col-sm-2'><label>Accion</label></td>
                </tr>
                </thead>
                <tbody>";

            $tipo_usuario = "";
            $i=1;
            while ($datos4 = mysqli_fetch_array($res4)) {
                if ($datos4['id_administrador'] != null) {
                    $tipo_usuario = "administrador";
                }
                if ($datos4['id_alumno'] != null) {
                    $tipo_usuario = "alumno";
                }
                if ($datos4['id_apoderado'] != null) {
                    $tipo_usuario = "apoderado";
                }
                if ($datos4['id_asistente'] != null) {
                    $tipo_usuario = "asistente";
                }
                if ($datos4['id_director'] != null) {
                    $tipo_usuario = "director";
                }
                if ($datos4['id_inspector'] != null) {
                    $tipo_usuario = "inspector";
                }
                if ($datos4['id_profesor'] != null) {
                    $tipo_usuario = "profesor";
                }
                if ($datos4['id_secretaria'] != null) {
                    $tipo_usuario = "secretaria";
                }
                if ($datos4['id_utp'] != null) {
                    $tipo_usuario = "utp";
                }

                echo "
                        <tr>
                            <td>$datos4[nombre_usr] $datos4[apellido_p_usr] $datos4[apellido_m_usr]</td>
                            <td>$tipo_usuario</td>
                            <td>
                                <input type='hidden' id='rut_$i' value='$datos4[rut_usr]'>
                                <input type='button' class='btn btn-info' value='Cambiar' onclick='cambiar($i)'>
                            </td>
                        </tr>
                        ";
                $i++;
            }
            echo"
            </tbody >
            </table >
        </div>";
        }
        ?>
    <?php
    $sql = "SELECT DISTINCT alumno.rut_usr, usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr,
                curso.id_curso, curso.nombre_curso, asistencia.fecha
                FROM asistencia 
                INNER JOIN alumno ON alumno.id_alumno = asistencia.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                INNER JOIN curso ON curso.id_curso = lista.id_curso
                WHERE asistencia.estado = 0 AND asistencia.justificacion = 1 AND lista.anio = YEAR(NOW())
                ORDER BY curso.id_curso, usuario.nombre_usr";

    $res = $dbcon->query($sql);
    if(mysqli_num_rows($res)>0) {
        echo "
    
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