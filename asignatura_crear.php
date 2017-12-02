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

    <script src="js/asignatura_crear.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal" style="min-height: 540px;">
<div class="col-sm-offset-0 col-sm-12">
    <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">
        <div id="form" class="form-group col-sm-offset-0 col-sm-12">
            <form class="form-inline">
            <label for="asig" class="control-label col-sm-offset-0 col-sm-12">Nombre Asignatura</label>
            <div class="col-sm-offset-4 col-sm-4">
                <input type="text" class="form-control" id="asig">
            </div>
                <div class="col-sm-offset-0 col-sm-12">
                <input type="button" class="btn btn-success" id="agregar" value="Agregar" style="margin: 5px">
                </div>
            </form>
        </div>
        <div id="lista" class="col-sm-offset-2 col-sm-8">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td><label>N°</label></td>
                    <td><label>Nombre Asignatura</label></td>
                    <td><label>Editar</label></td>
                    <td><label>Eliminar</label></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM asignatura ORDER BY nombre_asignatura";
                $res=$dbcon->query($sql);
                $i = 1;
                while ($datos = mysqli_fetch_array($res)){
                    echo"<tr>
                            <td>$i</td>
                            <td>$datos[nombre_asignatura]</td>
                            <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_asignatura($datos[id_asignatura], $i);'></td>
                            <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_asignatura($datos[id_asignatura], $i);'></td>
                         </tr>";
                    $i++;
                }
                ?>
                </tbody>
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