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
    <title>Inicio Apoderado</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script type="text/javascript">
        function mostrar(ref) {
            window.location.href = "ver_alumno_apo.php?id="+ref;
        }
    </script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_apoderado.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">

            <h3>Alumnos</h3>

            <?php
            $sql = "SELECT * FROM alumno
                    inner join apoderado on apoderado.id_apoderado = alumno.id_apoderado
                    inner join usuario on usuario.rut_usr = alumno.rut_usr
                    where apoderado.rut_usr = '$_SESSION[rut_usr]'";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"<div class='col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                        <input class='btn btn-info' value='$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]' onclick='mostrar($datos[id_alumno])' style='margin-bottom: 2%'>
                     </div>";
            }

            $sql2 = "SELECT * FROM alumno
                     inner join apoderado on apoderado.id_apoderado = alumno.id_suplente
                     inner join usuario on usuario.rut_usr = alumno.rut_usr
                     where apoderado.rut_usr = '$_SESSION[rut_usr]'";
            $res2 = $dbcon->query($sql2);
            while($datos2 = mysqli_fetch_array($res2)){
                echo"<div class='col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                        <input class='btn btn-info' value='$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]' onclick='mostrar($datos2[id_alumno])' style='margin-bottom: 2%'>
                     </div>";
            }
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