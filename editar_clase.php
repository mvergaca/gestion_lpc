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

    <script src="js/editar_clase.js"></script>
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
            echo"<h3>$datos[nombre_curso]</h3>
            <input type='hidden' id='curso' value='$datos[id_curso]'>
            <input type='hidden' id='clase' value='$_GET[id]'>";
        }
        ?>
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">

            <div class="col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="asignatura" class="col-sm-offset-3 col-sm-2">Asignatura</label>
                <div class="col-sm-4">
                <select id="asignatura" class="form-control">
                    <?php
                    $sql4 ="SELECT * FROM clase 
                            INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                            WHERE id_clase = $_GET[id]";
                    $res4 = $dbcon->query($sql4);
                    while($datos4 = mysqli_fetch_array($res4)){
                        echo"<option value='$datos4[id_asignatura]'>$datos4[nombre_asignatura]</option>";
                    }
                    $res4->close();

                    $sql2 = "SELECT * FROM asignatura ORDER by nombre_asignatura";
                    $res2 = $dbcon->query($sql2);
                    while ($datos2 = mysqli_fetch_array($res2)){
                        echo"<option value='$datos2[id_asignatura]'>$datos2[nombre_asignatura]</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="profesor" class="col-sm-offset-3 col-sm-2">Profesor</label>
                <div class="col-sm-4">
                <select id="profesor" class="form-control">
                    <?php
                    $sql5 ="SELECT * FROM clase 
                            INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                            INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                            WHERE id_clase = $_GET[id]";
                    $res5 = $dbcon->query($sql5);
                    while($datos5 = mysqli_fetch_array($res5)){
                        echo"<option value='$datos5[id_profesor]'>$datos5[nombre_usr] $datos5[apellido_p_usr] $datos5[apellido_m_usr]</option>";
                        $anio = $datos5['anio'];
                    }
                    $res5->close();

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

            <div class="col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="anio" class="col-sm-offset-3 col-sm-2">Año</label>
                <div class="col-sm-4">
                <input type="text" id="anio" class="form-control" value="<?php echo"$anio";?>">
                </div>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin: 5px">
                <input type="button" class="btn btn-success" id="guardar" value="Guardar">
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