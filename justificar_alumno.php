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

    <script src="js/justificar.js"></script>

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
            <?php
            $sql = "SELECT * FROM alumno
                    INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                    WHERE alumno.id_alumno = $_GET[id]";
            $res = $dbcon -> query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"
                <h4>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</h4>
                <input type='hidden' id='id_alumno' value='$_GET[id]'>
                ";
            }
            ?>

            <div class="col-sm-offset-0 col-sm-12">
                <div class="col-sm-offset-4 col-sm-2">
                    <label>Apoderado</label>
                </div>
                <div class="col-sm-3">
                    <select id="apoderado" class="form-control">
                        <option value=""> - - - </option>
                        <?php
                        $sql2 = "SELECT * FROM alumno
                                INNER JOIN apoderado ON apoderado.id_apoderado = alumno.id_apoderado
                                INNER JOIN usuario ON usuario.rut_usr = apoderado.rut_usr
                                WHERE alumno.id_alumno = $_GET[id]";
                        $res2 = $dbcon->query($sql2);
                        while($datos2 = mysqli_fetch_array($res2)){
                            echo"<option value='$datos2[id_apoderado]'>$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]</option>";
                        }

                        $sql3 = "SELECT * FROM alumno
                                INNER JOIN apoderado ON apoderado.id_apoderado = alumno.id_suplente
                                INNER JOIN usuario ON usuario.rut_usr = apoderado.rut_usr
                                WHERE alumno.id_alumno = $_GET[id]";
                        $res3 = $dbcon->query($sql3);
                        while($datos3 = mysqli_fetch_array($res3)){
                            echo"<option value='$datos3[id_apoderado]'>$datos3[nombre_usr] $datos3[apellido_p_usr] $datos2[apellido_m_usr]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 3%">
                <div class="col-sm-offset-0 col-sm-12">
                    <label>Justificacion</label>
                </div>
                <div class="col-sm-offset-0 col-sm-12">
                    <textarea class="form-control" id="motivo" style="height: 80px"></textarea>
                </div>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <input type="button" class="btn btn-success" value="Justificar" id="justificar" style="margin-bottom: 2%">
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