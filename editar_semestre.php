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

    <script src="js/editar_semestre.js"></script>
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

            <?php
                $id = $_GET["id"];
                echo"<input type='hidden' id='sem' value='$id'>";
                $sql = "SELECT * FROM semestre WHERE id_semestre = $id";
                $res = $dbcon->query($sql);
                while ($datos = mysqli_fetch_array($res)){
                    $nombre = $datos["nombre_sem"];
                    $inicio = $datos["inicio_semestre"];
                    $fin = $datos["fin_semestre"];
                }
            ?>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="semestre" class="col-sm-offset-3 col-sm-2">Semestre</label>
                <div class="col-sm-4">
                    <select id="semestre" class="form-control">
                        <option value="<?php echo"$nombre";?>"><?php echo"$nombre";?></option>
                        <option value="Primer Semestre">Primer Semestre</option>
                        <option value="Segundo Semestre">Segundo Semestre</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="inicio" class="col-sm-offset-3 col-sm-2">Inicio</label>
                <div class="col-sm-4">
                    <input type="date" id="inicio" class="form-control" value="<?php echo"$inicio";?>">
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="termino" class="col-sm-offset-3 col-sm-2">Termino</label>
                <div class="col-sm-4">
                    <input type="date" id="termino" class="form-control" value="<?php echo"$fin";?>">
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <div class="col-sm-offset-0 col-sm-12">
                    <input type="button" class="btn btn-success" id="guardar" value="Guardar" style="margin: 5px">
                </div>
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