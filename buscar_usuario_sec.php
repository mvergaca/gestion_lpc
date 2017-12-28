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
    <title>Inicio Secretaria</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script src="js/buscar_usuario_sec.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_secretaria.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div id="usr" class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">

            <div>
                <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                    <label for="rut" class="col-sm-offset-4 col-sm-1">Rut</label>
                    <div class="col-sm-3">
                        <input type="text" id="rut" class="form-control">
                    </div>
                </div>

                <div class="form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                    <input type="button" id="buscar" class="btn btn-success" value="Buscar">
                </div>
            </div>

            <div id="resultado" class="col-sm-offset-2 col-sm-8" style="margin-top: 3%">

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