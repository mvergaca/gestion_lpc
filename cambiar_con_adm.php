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

    <script type="text/javascript">
        $(document).ready(function () {
           $("#guardar").click(function () {
               var rut = $("#rut").val();
               var contra = $("#contra").val();
               if(contra != "") {
                   $.ajax({
                       type: "POST",
                       url: "guardar_con.php",
                       data: {
                           "rut": rut,
                           "contra":contra
                       },
                       success: function (data) {
                           datos = data.split(";");
                           if (datos[1] == 1) {
                               alert("Contraseña cambiada");
                               window.location.href = "inicio_administrador.php";
                           }
                           else {
                               alert("Error al cambiar contraseña");
                           }
                       }
                   });
               }
               else{
                   alert("Ingrese una nueva contraseña");
               }
           });
        });
    </script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
<div class='col-sm-offset-0 col-sm-12'>
    <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">
        <div class="col-sm-offset-0 col-sm-12">
            <?php
            $sql = "SELECT * FROM recupera
                    INNER JOIN usuario ON usuario.rut_usr = recupera.rut_usr
                    WHERE usuario.rut_usr = '$_GET[rut]' AND recupera.estado = 1";
            $res = $dbcon ->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"
                <input type='hidden' id='rut' value='$_GET[rut]'>
                <h4>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</h4>
                <div class='col-sm-offset-0 col-sm-12'>
                <div class='col-sm-offset-3 col-sm-3'>
                    <label>Rut usuario</label>
                </div>
                <div class='col-sm-4'>
                    $_GET[rut]
                </div>
                </div>
                <div class='col-sm-offset-0 col-sm-12'>
                <div class='col-sm-offset-3 col-sm-3'>
                    <label>Correo</label>
                </div>
                <div class='col-sm-4'>
                    $datos[correo]
                </div>
                </div>
                ";
            }
            ?>
        </div>
        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 3%">
            <div class="col-sm-offset-3 col-sm-3">
                <label>Nueva contraseña</label>
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="contra">
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <input type="button" class="btn btn-success" id="guardar" value="Guardar" style="margin-bottom: 3%">
            </div>
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