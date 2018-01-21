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
    <title>Inicio Asistente</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script src="js/buscar_casos_sociales.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_asistente.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <h3>Buscar casos sociales</h3>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <label class="col-sm-offset-4 col-sm-1">Desde</label>
                <div class="col-sm-3">
                    <input type="date" id="desde" class="form-control">
                </div>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <label class="col-sm-offset-4 col-sm-1">Hasta</label>
                <div class="col-sm-3">
                    <input type="date" id="hasta" class="form-control">
                </div>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <input type="button" value="Buscar" class="btn btn-success" id="buscar">
            </div>

            <div class="col-sm-offset-0 col-sm-12">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <td class="col-sm-1"><label>N°</label></td>
                        <td class="col-sm-4"><label>Asistente</label></td>
                        <td class="col-sm-4"><label>Alumno</label></td>
                        <td class="col-sm-2"><label>Fecha</label></td>
                        <td class="col-sm-1"><label>Ver</label></td>
                    </tr>
                    </thead>
                    <thead id="filas">

                    </thead>
                </table>
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