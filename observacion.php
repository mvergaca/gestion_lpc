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

    <script src="js/observacion.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_profesor.php";
    ?>
</section>

<section id="principal">
    <div align="center">
        <?php
        $curso = $_GET['curso'];
        $asignatura = $_GET['asig'];
        $sql = "SELECT * FROM profesor
                WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
        $res = $dbcon ->query($sql);
        while ($dato = mysqli_fetch_array($res)){
            $id_profe = $dato['id_profesor'];
            echo"<input type='hidden' id='profesor' value='$id_profe'>";
        }
        $res -> close();
        ?>
        <div class="col-sm-offset-4 col-sm-4">
        <label>Alumnos</label><select id="alumnos" class="form-control">
            <option value="">Alumnos</option>
            <?php
            $sql2 = "SELECT * FROM alumno
                      INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                      INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                      WHERE lista.id_curso = $curso";
            $res2 = $dbcon->query($sql2);
            while($datos2 = mysqli_fetch_array($res2)){
                echo"<option value='$datos2[id_alumno]'>$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]</option>";
            }
            ?>
        </select></div>
        <div class="col-sm-offset-1 col-sm-10">
            <textarea id="observacion" class="col-sm-offset-3 col-sm-6 col-xs-offset-0 col-xs-12" style="margin-top: 2%;height: 100px"></textarea>
        </div>
<div class="col-sm-offset-4 col-sm-4" style="margin-top: 2%">
        <input type="button" id="guardar" value="Guardar" class="btn btn-info">
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