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
    <div class="col-sm-offset-0 col-sm-12">
    <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>

        <?php

        $sql3 = "SELECT * FROM curso WHERE id_curso = $_GET[curso]";
        $res3 = $dbcon->query($sql3);
        while($datos3 = mysqli_fetch_array($res3)){
            $nombre_curso = $datos3['nombre_curso'];
        }

        $sql4 = "SELECT * FROM asignatura WHERE id_asignatura = $_GET[asig]";
        $res4 = $dbcon->query($sql4);
        while($datos4 = mysqli_fetch_array($res4)){
            $nombre_asig = $datos4['nombre_asignatura'];
        }

        echo"<h3>$nombre_asig - $nombre_curso</h3>
                <input type='hidden' id='curso' value='$_GET[curso]'>
                <input type='hidden' id='asig' value='$_GET[asig]'>";

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
        <div class="col-sm-offset-0 col-sm-12" style="margin: 1%">
            <label class="col-sm-offset-4 col-sm-1">Alumnos</label>
            <div class="col-sm-4">
            <select id="alumnos" class="form-control">
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
            </select>
            </div>
        </div>
        <div class="col-sm-offset-0 col-sm-12">

            <label class="col-sm-offset-4 col-sm-1" >Positiva</label>
            <div class="col-sm-1">
                <input type="radio" id="positiva" name="tipo" checked>
            </div>


            <label class="col-sm-1" >Negativa</label>
            <div class="col-sm-1">
                <input type="radio" id="negativa" name="tipo">
            </div>
        </div>
        <div class="col-sm-offset-0 col-sm-12" style="margin: 1%">
            <textarea id="observacion" class="form-control" style="height: 100px"></textarea>
        </div>
<div class="col-sm-offset-4 col-sm-4" style="margin-top: 1%">
        <input type="button" id="guardar" value="Guardar" class="btn btn-info">
</div>
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