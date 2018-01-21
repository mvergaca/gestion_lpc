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


</head>
<body>

<section id="encabezado">
    <?php
    include "head_asistente.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <h3>Caso Social</h3>
            <?php
            $sql = "SELECT * FROM caso_social WHERE id_caso_social = $_GET[id]";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"
                <div class='col-sm-offset-0 col-sm-12' style='margin-bottom: 1%'>
                    <label class='col-sm-offset-0 col-sm-12'>Asistente</label>";
                    $sql2 = "SELECT * FROM asistente 
                            INNER JOIN usuario ON usuario.rut_usr = asistente.rut_usr
                            WHERE asistente.id_asistente = $datos[id_asistente]";
                    $res2 = $dbcon->query($sql2);
                    while($datos2 = mysqli_fetch_array($res2)){
                        echo"$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]";
                    }
                    $res2->close();
                echo"    
                </div>
                <div class='col-sm-offset-0 col-sm-12' style='margin-bottom: 1%'>
                    <label class='col-sm-offset-0 col-sm-12'>Alumno</label>";
                    $sql3 = "SELECT * FROM alumno
                            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                            WHERE alumno.id_alumno = $datos[id_alumno]";
                    $res3 = $dbcon->query($sql3);
                    while($datos3 = mysqli_fetch_array($res3)){
                        echo"$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]";
                    }
                    $res3->close();
                echo"    
                </div>
                <div class='col-sm-offset-0 col-sm-12' style='margin-bottom: 1%'>
                    <label class='col-sm-offset-0 col-sm-12'>Descripcion</label>
                    $datos[descripcion_caso]
                </div>
                <div class='col-sm-offset-0 col-sm-12' style='margin-bottom: 1%'>
                    <label class='col-sm-offset-0 col-sm-12'>Imagen</label>
                    <img src='$datos[imagen]'>
                </div>
                ";
            }
            $res->close();
            ?>
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