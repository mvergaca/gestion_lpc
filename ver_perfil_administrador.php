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
    <title>Inicio Administrador</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script>
        $(document).ready(function () {
            $("#editar").click(function () {
                window.location.href = "modificar_perfil_administrador.php";
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
    <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
        <div class="col-sm-offset-2 col-sm-8">
            <h3>Perfil de usuario</h3>
            <table class='table table-bordered table-responsive'>
                <?php
                $sql = "SELECT * FROM usuario WHERE rut_usr = '$_SESSION[rut_usr]'";
                $res = $dbcon->query($sql);
                while ($datos = mysqli_fetch_array($res)){
                    echo"
                
                <tr>
                    <td><label>Rut</label></td>
                    <td>$datos[rut_usr]</td>
                </tr>
                <tr>
                    <td><label>Nombre</label></td>
                    <td>$datos[nombre_usr]</td>
                </tr>
                <tr>
                    <td><label>Apellido Paterno</label></td>
                    <td>$datos[apellido_p_usr]</td>
                </tr>
                <tr>
                    <td><label>Apellido Materno</label></td>
                    <td>$datos[apellido_m_usr]</td>
                </tr>
                <tr>
                    <td><label>Fecha Nacimiento</label></td>
                    <td>$datos[fecha_n_usr]</td>
                </tr>
                <tr>
                    <td><label>Genero</label></td>
                    <td>$datos[genero_usr]</td>
                </tr>
                <tr>
                    <td><label>Telefono</label></td>
                    <td>$datos[telefono_usr]</td>
                </tr>
                <tr>
                    <td><label>Correo</label></td>
                    <td>$datos[correo_usr]</td>
                </tr>
                <tr>
                    <td><label>Direccion</label></td>
                    <td>$datos[direccion_usr]</td>
                </tr>
                <tr>
                    <td><label>Comuna</label></td>
                    <td>$datos[comuna_usr]</td>
                </tr>
                ";
                }
                ?>
            </table>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <input type="button" class="btn btn-success" id="editar" value="Editar informacion">
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