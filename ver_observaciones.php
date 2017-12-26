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
    <title>Inicio Profesor</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <script src="js/ver_clase.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_profesor.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">

        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <?php
            $sql2 = "SELECT * FROM curso
             INNER JOIN clase ON clase.id_curso = curso.id_curso
             INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
             WHERE asignatura.id_asignatura = $_GET[asi] AND curso.id_curso = $_GET[curso]";
            $res2 = $dbcon ->query($sql2);
            while ($datos2 = mysqli_fetch_array($res2)) {
                $curso = $datos2['nombre_curso'];
                $asig = $datos2['nombre_asignatura'];
            }
            $res2 ->close();

            echo"<h4>Observaciones $asig $curso </h4>";
            ?>

            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td><label>Alumno</label></td>
                    <td><label>Observacion</label></td>
                    <td><label>Tipo</label></td>
                    <td><label>Fecha</label></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM observacion
                        INNER JOIN profesor ON profesor.id_profesor = observacion.id_profesor
                        INNER JOIN alumno ON alumno.id_alumno = observacion.id_alumno
                        INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                        INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                        INNER JOIN curso ON curso.id_curso = lista.id_curso
                        INNER JOIN clase ON clase.id_curso = curso.id_curso
                        INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                        WHERE profesor.rut_usr = '$_SESSION[rut_usr]' AND curso.id_curso = $_GET[curso] AND asignatura.id_asignatura = $_GET[asi]
                        AND lista.anio = 2017
                        ORDER BY usuario.nombre_usr, observacion.tipo_obs, observacion.fecha_hora";

                $res = $dbcon->query($sql);

                while ($datos = mysqli_fetch_array($res)){
                    if($datos['tipo_obs'] == 0){
                        $obs = 'negativa';
                    }
                    else{
                        $obs = 'positiva';
                    }
                    echo"
                    <tr>
                        <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                        <td>$datos[observacion]</td>
                        <td>$obs</td>
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