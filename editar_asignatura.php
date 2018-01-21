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

    <script src="js/editar_asignatura.js"></script>
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
            <h3>Editar asignatura</h3>
            <?php
            $sql = "SELECT * FROM asignatura WHERE id_asignatura = $_GET[id]";
            $res = $dbcon->query($sql);
            while($dat=mysqli_fetch_array($res)){
                $nombre = $dat['nombre_asignatura'];
                $prome = $dat['promediable'];
            }
            $res->close();
            echo"<input type='hidden' id='id_as' value='$_GET[id]'>";
            ?>

            <div id="form" class="form-group col-sm-offset-0 col-sm-12">
                <form class="form-inline">
                    <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                        <label for="asig" class="control-label col-sm-offset-0 col-sm-12">Nombre Asignatura</label>
                        <div class="col-sm-offset-4 col-sm-4">
                            <input type="text" class="form-control" id="asig" value="<?php echo"$nombre";?>">
                        </div>
                    </div>

                    <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                        <label class="col-sm-offset-4 col-sm-3">Promediable</label>
                        <div class="col-sm-1">
                            <input type="radio" name="prom" id="si" <?php if($prome == 1){echo"checked";}?>>
                        </div>
                    </div>

                    <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                        <label class="col-sm-offset-4 col-sm-3">No Promediable</label>
                        <div class="col-sm-1">
                            <input type="radio" name="prom" id="no" <?php if($prome == 0){echo"checked";}?>>
                        </div>
                    </div>

                    <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                        <input type="button" class="btn btn-success" id="guardar" value="Guardar" style="margin: 5px">
                    </div>
                </form>
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