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

    <script src="js/crear_caso_social.js"></script>
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
        <h3>Crear caso social</h3>

        <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
            <label class="col-sm-offset-4 col-sm-1">Curso</label>
            <div class="col-sm-3">
                <select id="curso" class="form-control" onchange="cargar_curso();">
                    <option value=""> - - - </option>
                    <?php
                    $sql = "SELECT * FROM curso";
                    $res = $dbcon->query($sql);
                    while($datos = mysqli_fetch_array($res)){
                        echo"<option value='$datos[id_curso]'>$datos[nombre_curso]</option>";
                    }
                    $res->close();

                    $sql2 = "SELECT * FROM asistente WHERE asistente.rut_usr = '$_SESSION[rut_usr]'";
                    $res2 = $dbcon->query($sql2);
                    while($datos2 = mysqli_fetch_array($res2)){
                        echo"<input type='hidden' id='asistente' value='$datos2[id_asistente]'>";
                    }
                    $res2->close();
                    ?>
                </select>
            </div>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
            <label class="col-sm-offset-4 col-sm-1">Alumno</label>
            <div class="col-sm-3">
                <select id="alumno" class="form-control" style="font-size: 12px">
                    <option value=""> - - - </option>

                </select>
            </div>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
            <label class="col-sm-offset-0 col-sm-12">Descipcion</label>
            <div class="col-sm-offset-2 col-sm-8">
            <textarea id="descripcion" class="form-control" placeholder="Descripcion" style="height: 150px"></textarea>
            </div>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
            <label class="col-sm-offset-0 col-sm-12">Imagen</label>
            <div class="col-sm-offset-0 col-sm-12" align="center" style="margin-bottom: 2%">
                <input type="file" id="archivo" onchange="subir_archivo(this);">
                <input type="button" class="btn btn-danger" value="quitar" id="quitar" style="margin-top: 1%">
                <input type="hidden" id="ruta" value="">
            </div>
            <div id="img_sel" class="col-sm-offset-0 col-sm-12" >

            </div>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
            <input type="button" id="guardar" class="btn btn-success" value="Crear">
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