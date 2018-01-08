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
    <title>Inicio Apoderado</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <script type="text/javascript">
        $(document).ready(function () {
            $("#guardar").click(function () {
                var antigua = $("#old_pass").val();
                var nueva = $("#new_pass").val();
                var repetir = $("#rep_pass").val();

                alert(antigua+"-"+nueva+"-"+repetir);

                if(antigua != "" && nueva != "" && repetir != ""){
                    if(nueva.localeCompare(repetir) == 0){

                        $.ajax({
                            type: "POST",
                            url: "cambiar_contraseña.php",
                            data: {
                                "antigua":antigua,
                                "nueva":nueva
                            },
                            success: function (data) {
                                datos = data.split(";");
                                if(datos[1] == 1){
                                    alert("Contraseña cambiada exitosamente");
                                    alert(datos[2]);
                                    window.location.href = "inicio_apoderado.php";
                                }
                                else{
                                    alert("Error al cambiar la contraseña");

                                }
                            }
                        });

                    }
                    else{
                        alert("Las Contraseñas no coinciden");
                    }
                }
                else{
                    alert("Todos los campos son requeridos");
                }
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
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <h3>Cambio de Contraseña</h3>
            <div class="col-sm-offset-2 col-sm-8">
                <table class="table table-responsive table-bordered">
                    <tr>
                        <td><label>Antigua Contraseña</label></td>
                        <td><input type="password" id="old_pass" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label>Nueva Contraseña</label></td>
                        <td><input type="password" id="new_pass" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label>Repetir contraseña</label></td>
                        <td><input type="password" id="rep_pass" class="form-control"></td>
                    </tr>
                </table>
                <div style="margin-bottom: 2%">
                    <input type="button" id="guardar" value="guardar" class="btn btn-success">
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