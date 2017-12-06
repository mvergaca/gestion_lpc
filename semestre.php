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

    <script src="js/semestre.js"></script>
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

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="semestre" class="col-sm-offset-3 col-sm-2">Semestre</label>
                <div class="col-sm-4">
                    <select id="semestre" class="form-control">
                        <option value="Primer Semestre">Primer Semestre</option>
                        <option value="Segundo Semestre">Segundo Semestre</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="inicio" class="col-sm-offset-3 col-sm-2">Inicio</label>
                <div class="col-sm-4">
                    <input type="date" id="inicio" class="form-control">
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="termino" class="col-sm-offset-3 col-sm-2">Termino</label>
                <div class="col-sm-4">
                    <input type="date" id="termino" class="form-control">
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <div class="col-sm-offset-0 col-sm-12">
                    <input type="button" class="btn btn-success" id="guardar" value="Guardar" style="margin: 5px">
                </div>
            </div>

            <div id="lista" class="form-group col-sm-offset-0 col-sm-12">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <td><label>Nombre Semestre</label></td>
                        <td><label>Inicio Semestre</label></td>
                        <td><label>Fin Semestre</label></td>
                        <td><label>Editar</label></td>
                        <td><label>Eliminar</label></td>
                    </tr>
                    </thead>
                <tbody>
                <?php
                $año = date('Y');

                $sql = "SELECT * from semestre WHERE anio = $año";
                $res = $dbcon->query($sql);
                $i = 1;
                while ($datos = mysqli_fetch_array($res)){
                    echo"
                    <tr id='fila_$i'>
                        <td>$datos[nombre_sem] $datos[anio]</td>
                        <td>$datos[inicio_semestre]</td>
                        <td>$datos[fin_semestre]</td>
                        <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_semestre($datos[id_semestre]);'></td>
                        <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_semestre($datos[id_semestre],$i);'></td>
                    </tr>
                    ";
                    $i++;
                }
                ?>
                </tbody>
                </table>
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