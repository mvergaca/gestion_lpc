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

    <script src="js/asignatura_asignar.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal" style="min-height: 540px;">
<div class="col-sm-offset-0 col-sm-12">
    <?php
    $sql = "SELECT * FROM curso WHERE id_curso = $_GET[curso]";
    $res = $dbcon->query($sql);
    while ($datos = mysqli_fetch_array($res)){
        $nombre_curso = $datos["nombre_curso"];
        echo"<input type='hidden' id='curso' value='$datos[id_curso]'>";
    }
    ?>
    <div class="col-sm-offset-3 col-sm-6" style="background-color: #f7ecb5;">
        <?php echo"<h3>$nombre_curso</h3>"?>
        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="asignatura" class="col-sm-offset-2 col-sm-3">Asignatura</label>
            <div class="col-sm-5">
            <select id="asignatura" class="form-control">
                <option value=""> - - - </option>
                <?php
                $sql2 = "SELECT * FROM asignatura ORDER by nombre_asignatura";
                $res2 = $dbcon->query($sql2);
                while ($datos2 = mysqli_fetch_array($res2)){
                    echo"<option value='$datos2[id_asignatura]'>$datos2[nombre_asignatura]</option>";
                }
                ?>
            </select>
            </div>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="profesor" class="col-sm-offset-2 col-sm-3">Profesor</label>
            <div class="col-sm-5">
            <select id="profesor" class="form-control">
                <option value=""> - - - </option>
                <?php
                $sql3 = "SELECT * FROM profesor
                INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                ORDER BY usuario.nombre_usr";
                $res = $dbcon->query($sql3);
                while ($datos3 = mysqli_fetch_array($res)){
                    echo "<option value='$datos3[id_profesor]' style='font-size: 12px'>$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</option>";
                }
                ?>
            </select>
            </div>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="anio" class="col-sm-offset-2 col-sm-3">Año</label>
            <div class="col-sm-5">
            <input type="text" id="anio" class="form-control">
            </div>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%; margin-bottom: 2%">
            <input type="button" class="btn btn-success" id="guardar" value="Guardar">
        </div>
    </div>

    <div id="asignadas" class="col-sm-offset-2 col-sm-8 table-responsive" style="margin-top: 2%">
        <table class="table table-responsive table-bordered" style="background-color: #f7ecb5;">
            <thead>
            <tr>
                <th>Asignatura</th>
                <th>Profesor</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $anio = date("Y");
            $sql4 = "SELECT * FROM asignatura
                    INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                    INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                    INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                    WHERE clase.id_curso = $_GET[curso] AND anio = $anio";
            $res4 = $dbcon->query($sql4);
            $i = 1;
            while ($datos4 = mysqli_fetch_array($res4)){
                echo"<tr id='fila_$i'>
                        <td>$datos4[nombre_asignatura]</td>
                        <td>$datos4[nombre_usr] $datos4[apellido_p_usr] $datos4[apellido_m_usr]</td>
                        <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_clase($datos4[id_clase]);'></td>
                        <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_clase($datos4[id_clase],$i);'></td>
                    </tr>";
                $i++;
            }
            ?>
            </tbody>
        </table>

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