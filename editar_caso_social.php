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

    <script src="js/editar_caso_social.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_asistente.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">
            <h3>Editar caso social</h3>

            <?php
            $sql = "SELECT * FROM caso_social
                    INNER JOIN alumno ON alumno.id_alumno = caso_social.id_alumno
                    INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                    WHERE caso_social.id_caso_social = $_GET[id]";
            $res = $dbcon->query($sql);

            while($datos = mysqli_fetch_array($res)){
                echo"<h3>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</h3>
                    <input type='hidden' id='caso' value='$_GET[id]'>";
                $descripcion = $datos['descripcion_caso'];
                $imagen = $datos['imagen'];
            }

            ?>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <label class="col-sm-offset-0 col-sm-12">Descipcion</label>
                <div class="col-sm-offset-2 col-sm-8">
                    <textarea id="descripcion" class="form-control" style="height: 150px"><?php echo"$descripcion";?></textarea>
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <label class="col-sm-offset-0 col-sm-12">Imagen</label>
                <div class="col-sm-offset-0 col-sm-12" align="center" style="margin-bottom: 2%">
                    <input type="file" id="archivo" onchange="subir_archivo(this);">
                    <input type="button" class="btn btn-danger" value="quitar" id="quitar" style="margin-top: 1%">
                    <input type="hidden" id="ruta" value="">
                </div>
                <div id="img_sel" class="col-sm-offset-0 col-sm-12">
                    <img src="<?php echo"$imagen";?>">
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <input type="button" id="guardar" class="btn btn-success" value="Guardar">
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