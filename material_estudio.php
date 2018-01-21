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

    <script src="js/material_estudio.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_profesor.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">

            <?php
                echo"<input type='hidden' id='curso' value='$_GET[curso]'>
                    <input type='hidden' id='asig' value='$_GET[asigna]'>";
                $sql = "SELECT * FROM curso WHERE id_curso = $_GET[curso]";
                $res = $dbcon->query($sql);
                while($datos = mysqli_fetch_array($res)){
                    $curso = $datos['nombre_curso'];
                }

                $sql2 = "SELECT * FROM asignatura WHERE id_asignatura = $_GET[asigna]";
                $res2 = $dbcon->query($sql2);
                while($datos2 = mysqli_fetch_array($res2)){
                    $asignatura = $datos2['nombre_asignatura'];
                }

                echo"<h3>Subir material $asignatura $curso</h3>";

                $sql3 = "SELECT * FROM clase
                          WHERE clase.id_curso = $_GET[curso] AND clase.id_asignatura = $_GET[asigna]
                          ";
                $res3 = $dbcon->query($sql3);
                while($datos3 = mysqli_fetch_array($res3)){
                    echo"<input type='hidden' id='clase' value='$datos3[id_clase]'>";
                }

                $sql4 = "SELECT * FROM profesor
                          WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
                $res4 = $dbcon->query($sql4);
                while($datos4 = mysqli_fetch_array($res4)){
                    echo"<input type='hidden' id='profesor' value='$datos4[id_profesor]'>";
                }
            ?>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <label class="col-sm-offset-0 col-sm-12">Detalle</label>
                <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                    <textarea class="form-control" id="detalle"></textarea>
                </div>
                <div class="col-sm-offset-0 col-sm-12" align="center" style="margin-bottom: 2%">
                    <label class="col-sm-offset-0 col-sm-12">Archivo</label>
                    <input type="file" id="archivo" onchange="subir_archivo(this);">
                    <input type="button" class="btn btn-danger" value="quitar" id="quitar" style="margin-top: 1%">
                    <input type="hidden" id="ruta" value="">
                </div>
                <div id="img_sel" class="col-sm-offset-0 col-sm-12" >

                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <input type="button" id="publicar" class="btn btn-success" value="Publicar">
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