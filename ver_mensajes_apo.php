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
                $sql = "SELECT * FROM alumno
                        inner join usuario on usuario.rut_usr = alumno.rut_usr
                        where alumno.id_alumno = $_GET[id]";
                $res = $dbcon->query($sql);
                while($datos = mysqli_fetch_array($res)){
                    echo"<h4>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</h4>";
                }

                $sql2 = "select * from mensaje
                        inner join curso on curso.id_curso = mensaje.id_curso
                        inner join lista on lista.id_curso = curso.id_curso
                        inner join profesor on profesor.id_profesor = mensaje.id_profesor
                        inner join usuario on usuario.rut_usr = profesor.rut_usr
                        inner join asignatura on asignatura.id_asignatura = mensaje.id_asignatura
                        where lista.id_alumno = $_GET[id] and mensaje.fecha_mensaje > current_date()";
                $res2= $dbcon->query($sql2);

                echo"<div class='col-sm-offset-0 col-sm-12'>
                    <table class='table table-responsive table-bordered'>
                        <thead>
                            <tr>
                                <td class='col-sm-4'><label>Profesor</label></td>
                                <td class='col-sm-2'><label>Asignatura</label></td>
                                <td class='col-sm-2'><label>Fecha</label></td>
                                <td class='col-sm-4'><label>Mensaje</label></td>
                            </tr>
                        </thead>
                        <tbody>";
                            while($datos2 = mysqli_fetch_array($res2)){
                                echo"
                                <tr>
                                    <td>$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]</td>
                                    <td>$datos2[nombre_asignatura]</td>
                                    <td>$datos2[fecha_mensaje]</td>
                                    <td>$datos2[mensaje]</td>
                                </tr>
                                ";
                            }
                        echo"</tbody>
                    </table>
                </div>";

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