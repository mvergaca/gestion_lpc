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
    <title>Inicio Inspector</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script src="js/retirar_alumno_ins.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_inspector.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <h3>Retirar alumno</h3>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <label class="col-sm-offset-4 col-sm-2">Curso</label>
                <div class="col-sm-3">
                    <select class="form-control" id="curso" onchange="cargar_alumnos()">
                        <option> - - - </option>
                        <?php
                        $sql = "SELECT * FROM curso ORDER BY id_curso";
                        $res = $dbcon->query($sql);
                        while($datos = mysqli_fetch_array($res)){
                            echo"<option value='$datos[id_curso]'>$datos[nombre_curso]</option>";
                        }
                        $res->close();
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <label class="col-sm-offset-4 col-sm-2">Alumno</label>
                <div class="col-sm-3">
                    <select class="form-control" id="alumno" onchange="cargar_apoderado()">
                        <option> - - - </option>
                    </select>
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <label class="col-sm-offset-4 col-sm-2">Apoderado</label>
                <div class="col-sm-3">
                    <select class="form-control" id="apoderado">
                        <option> - - - </option>
                    </select>
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <label class="col-sm-offset-0 col-sm-12">Motivo</label>
                <div>
                    <textarea class="form-control" id="motivo"></textarea>
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <input type="button" value="Guardar" id="guardar" class="btn btn-success">
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