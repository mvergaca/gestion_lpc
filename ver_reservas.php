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

    <script src="js/ver_reserva.js"></script>

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
            <h3><label>Ver Reservas</label></h3>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="sala" class="col-sm-offset-3 col-sm-2">Sala</label>
                <div class="col-sm-4">
                    <select id="sala" class="form-control">
                        <option value=""> - - - </option>
                        <?php
                        $sql="SELECT * FROM sala
                                      ORDER BY nombre_sala";
                        $res = $dbcon->query($sql);
                        while ($datos = mysqli_fetch_array($res)){
                            echo"<option style='font-size: 12px' value='$datos[id_sala]'>$datos[nombre_sala]</option>";
                        }
                        $res->close();
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="desde" class="col-sm-offset-3 col-sm-2">Desde</label>
                <div class="col-sm-4">
                    <input type="date" id="desde" class="form-control">
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="hasta" class="col-sm-offset-3 col-sm-2">Hasta</label>
                <div class="col-sm-4">
                    <input type="date" id="hasta" class="form-control">
                </div>
            </div>

            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <div class="col-sm-offset-0 col-sm-12">
                    <input type="button" class="btn btn-success" id="buscar" value="Buscar" style="margin: 5px">
                </div>
            </div>

            <div id="lista" class="col-sm-offset-1 col-sm-10">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <td style='width: 5%; border: #34a9b6 2px solid;'><label>N°</label></td>
                        <td style='width: 50%; border: #34a9b6 2px solid;'><label>Profesor</label></td>
                        <td style='width: 20%; border: #34a9b6 2px solid;'><label>Fecha</label></td>
                        <td style='width: 25%; border: #34a9b6 2px solid;'><label>Horario</label></td>
                    </tr>
                    </thead>
                    <tbody>
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