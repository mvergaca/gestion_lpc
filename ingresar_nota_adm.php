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

    <script src="js/ingresar_notas_adm.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal" style="min-height: 540px;">
<div class="col-sm-offset-0 col-sm-12" >
    <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>

    <div class=" col-sm-offset-0 col-sm-12" style="margin-top: 2%">
        <div class="col-sm-offset-4 col-sm-2">
            <label for="curso">Curso</label>
        </div>
        <div class="col-sm-3">
            <select id="curso" class="form-control" onchange="cargar_asignaturas();">
                <option value=""> - - - </option>
                <?php
                $sql = "SELECT * FROM curso";
                $res = $dbcon->query($sql);
                while($dat = mysqli_fetch_array($res)){
                    echo"<option value='$dat[id_curso]'>$dat[nombre_curso]</option>";
                }
                $res->close();
                ?>
            </select>
        </div>
    </div>

    <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
        <div class="col-sm-offset-4 col-sm-2">
            <label for="asignatura">Asignatura</label>
        </div>
        <div class="col-sm-3">
            <select id="asignatura" class="form-control">
                <option value=""> - - - </option>
            </select>
        </div>
    </div>
    <div>
        <input type="button" class="btn btn-info" value="Buscar" style="margin: 5px" onclick="mostrar_curso();">
    </div>
    <div id="notas" class="col-sm-offset-0 col-sm-12" >

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