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

    <script src="js/crear_citacion.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_inspector.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <?php
            $sql = "SELECT * FROM usuario
                    INNER JOIN alumno ON alumno.rut_usr = usuario.rut_usr
                    WHERE alumno.id_alumno = $_GET[id]";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"<h3>Citacion para $datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</h3>";
            }

            $sql2 = "SELECT * FROM inspector
                      WHERE rut_usr = '$_SESSION[rut_usr]'";
            $res2 = $dbcon->query($sql2);
            while($datos2 = mysqli_fetch_array($res2)){
                echo"<input type='hidden' id='ins' value='$datos2[id_inspector]'>";
            }

            echo"<input type='hidden' id='alumno' value='$_GET[id]'>";
            ?>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <label class="col-sm-offset-4 col-sm-2">Fecha</label>
                <div class="col-sm-3">
                    <input type="date" id="fecha" class="form-control">
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <label class="col-sm-offset-4 col-sm-2">Hora</label>
                <div class="col-sm-3">
                    <input type="time" id="hora" class="form-control">
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <label>Detalle</label>
                <textarea class="form-control" id="detalle" style="min-height: 100px"></textarea>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <input type="button" value="guardar" id="guardar" class="btn btn-success">
            </div>
        </div>
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