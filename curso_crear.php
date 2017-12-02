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

    <script src="js/curso_crear.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <form class="form-inline col-sm-offset-3 col-sm-6" style='background-color: #f7ecb5;'>

            <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <label for="establecimiento" class="col-sm-offset-0 col-sm-4">Establecimiento</label>
                <select id="establecimiento" class="form-control">
                    <?php
                    $sql = "SELECT * FROM establecimiento";
                    $res = $dbcon->query($sql);
                    while ($datos = mysqli_fetch_array($res)){
                        echo"<option value='$datos[id_establecimiento]' >$datos[nombre]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <label for="sala" class="col-sm-offset-0 col-sm-4">Sala</label>
                <select id="sala" class="form-control">
                    <option value=""> - - - </option>
                    <option value="" >Sala 1</option>
                </select>
            </div>

            <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <label for="profesor" class="col-sm-offset-0 col-sm-4">Profesor</label>
                <div class="col-sm-4 form">
                    <select id="profesor" class="form-control" style="font-size: 12px">
                        <option value="" > - - - </option>
                    <?php
                    $sql3 = "SELECT * FROM profesor
                             INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr ORDER BY usuario.nombre_usr";
                    $res3 = $dbcon->query($sql3);
                    while ($datos3 = mysqli_fetch_array($res3)){
                        echo"<option value='$datos3[id_profesor]' >$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</option>";
                    }
                    ?>
                    </select></div>
            </div>

            <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <label for="nombre" class="col-sm-offset-0 col-sm-4">Nombre Curso</label>
                <input type="text" id="nombre" class="form-control">
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <input type="button" id="guardar" class="btn btn-success" value="Guardar">
            </div>

        </form>
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