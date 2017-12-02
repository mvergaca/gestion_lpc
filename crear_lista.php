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

    <script src="js/crear_lista.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8">
            <form class="form-inline">
                <div class="col-sm-offset-0 col-sm-12">
                    <label>Curso</label>
                    <select id="curso" class="form-control">
                        <?php
                        $sql = "SELECT * FROM curso";
                        $res = $dbcon->query($sql);
                        while ($datos = mysqli_fetch_array($res)){
                            echo"<option value='$datos[id_curso]'>$datos[nombre_curso]</option>";
                        }
                     $res->close();
                        ?>
                    </select>
                </div>

                <div class="col-sm-offset-0 col-sm-12" style="margin-top: 5px">
                    <label>Año</label>
                    <input type="text" id="año" class="form-control">
                </div>

                <div class="col-sm-offset-0 col-sm-12" style="margin-top: 5px">
                    <input type="button" id="cargar" class="btn btn-success" value="cargar curso">
                </div>

                <div class="col-sm-offset-0 col-sm-12" style="margin-top:10px">
                    <table id="lista" class="table table-bordered table-responsive" style="background-color: #f7ecb5">
                        <thead>
                        <tr>
                            <th style="width: 30%">Rut Alumno</th>
                            <th style="width: 50%">Nombre Alumno</th>
                            <th style="width: 20%">Accion</th>
                        </tr>
                        </thead>
                        <tbody id="bod">
                        <tr id="fila_1">
                            <td id="col_1_1">
                                <input type="text" id="rut_1" class="form-control" placeholder="Rut">
                            </td>
                            <td id="col_1_2">
                                <input type="hidden" id="est_1">
                            </td>
                            <td id="col_1_3">
                                <input type="button" name="agregar" id="agregar_1" class="btn btn-success" value="Agregar" onclick="agregar_alumno(1);">
                                <input type="button" name="quitar" id="quitar_1" class="btn btn-danger" value="Quitar" onclick="quitar_alumno(1);">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div id="agregar" class="col-sm-offset-0 col-sm-12" style="margin-top:5px">
                    <input type="button" id="nueva_fila" value="Agregar Fila" class="btn btn-info">
                </div>

            </form>
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