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
        $(document).ready(function () {
            $("#notas").click(function () {
                var alumno = $("#alumno").val()
                window.location.href="ver_notas_apo.php?id="+alumno;
            });

            $("#mensajes").click(function () {
                var alumno = $("#alumno").val()
                window.location.href="ver_mensajes_apo.php?id="+alumno;
            });

            $("#justificaciones").click(function () {
                var alumno = $("#alumno").val()
                window.location.href="ver_justificaciones_apo.php?id="+alumno;
            });

            $("#observaciones").click(function () {
                var alumno = $("#alumno").val()
                window.location.href="ver_observaciones_apo.php?id="+alumno;
            });
        });
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
            <?php
            $sql = "SELECT * FROM alumno
                    inner join usuario on  usuario.rut_usr = alumno.rut_usr
                    where alumno.id_alumno = $_GET[id]";
            $res = $dbcon->query($sql);
            while ($datos = mysqli_fetch_array($res)){
                echo"<h4>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</h4>
                    <input type='hidden' id='alumno' value='$_GET[id]'>";
            }
            ?>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 1%">
                <input type="button" class="btn btn-success" value="Notas" id="notas" style="margin-bottom: 1%">
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 1%">
                <input type="button" class="btn btn-info" value="Mensajes" id="mensajes" style="margin-bottom: 1%">
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 1%">
                <input type="button" class="btn btn-warning" value="Justificaciones" id="justificaciones" style="margin-bottom: 1%">
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 1%">
                <input type="button" class="btn btn-danger" value="Observaciones" id="observaciones" style="margin-bottom: 2%">
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