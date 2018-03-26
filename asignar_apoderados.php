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

    <script src="js/asignar_apoderados.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">
            <h4>Asignar apoderados</h4>

            <div class="col-sm-offset-0 col-sm-12">
                <div class="col-sm-offset-3 col-sm-2">
                    <label>Rut alumno</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="rut_alumno" onchange="cargar_datos_alumno()">
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <div class="col-sm-offset-3 col-sm-2">
                    <label>Apoderado titular</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="rut_titular" onchange="cargar_datos_titular()">
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <div class="col-sm-offset-3 col-sm-2">
                    <label>Apoderado suplente</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="rut_suplente" onchange="cargar_datos_suplente()">
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12"style="margin-top: 2%">
                <input type="button" class="btn btn-success" id="guardar" value="Guardar" style="margin-bottom: 2%">
            </div>

            <div class="col-sm-offset-0 col-sm-12" id="datos_alumno">

            </div>

            <div class="col-sm-offset-0 col-sm-12" id="datos_titular">

            </div>

            <div class="col-sm-offset-0 col-sm-12" id="datos_suplente">

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