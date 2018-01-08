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
    <title>Inicio Director</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script src="js/guardar_perfil_director.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_director.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
        <div class="col-sm-offset-2 col-sm-8">
            <h3>Perfil de usuario</h3>
            <?php
            $sql = "SELECT * FROM usuario WHERE rut_usr = '$_SESSION[rut_usr]'";
            $res = $dbcon->query($sql);
            while ($datos = mysqli_fetch_array($res)){
                echo"
            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='rut' class='col-sm-offset-1 col-sm-4'>Rut</label>
                <div class='col-sm-6'>
                <input type='text' id='rut' class='form-control' value='$datos[rut_usr]' disabled>
                </div>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='nombre' class='col-sm-offset-1 col-sm-4'>Nombre</label>
                <div class='col-sm-6'>
                <input type='text' id='nombre' class='form-control' value='$datos[nombre_usr]'>
                </div>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='apellido_p' class='col-sm-offset-1 col-sm-4'>Apellido Paterno</label>
                <div class='col-sm-6'>
                <input type='text' id='apellido_p' class='form-control' value='$datos[apellido_p_usr]'>
                </div>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='apellido_m' class='col-sm-offset-1 col-sm-4'>Apellido Materno</label>
                <div class='col-sm-6'>
                <input type='text' id='apellido_m' class='form-control' value='$datos[apellido_m_usr]'>
                </div>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='fecha_n' class='col-sm-offset-1 col-sm-4'>Fecha Nacimiento</label>
                <div class='col-sm-6'>
                <input type='date' id='fecha_n' class='form-control' value='$datos[fecha_n_usr]'>
                </div>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='genero'>Masculino</label>
                <input type='radio' id='genero_m' name='genero' ";if($datos["genero_usr"] == "M") {echo"checked";}; echo">
                <label for='genero'>Femenino</label>
                <input type='radio' id='genero_f' name='genero' ";if($datos["genero_usr"] == "F") {echo"checked";}; echo">
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='telefono' class='col-sm-offset-1 col-sm-4'>Telefono</label>
                <div class='col-sm-6'>
                <input type='text' id='telefono' class='form-control' value='$datos[telefono_usr]'>
                </div>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='correo' class='col-sm-offset-1 col-sm-4'>Correo</label>
                <div class='col-sm-6'>
                <input type='email' id='correo' class='form-control' value='$datos[correo_usr]'>
                </div>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='direccion' class='col-sm-offset-1 col-sm-4'>Direccion</label>
                <div class='col-sm-6'>
                <input type='text' id='direccion' class='form-control' value='$datos[direccion_usr]'>
                </div>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='comuna' class='col-sm-offset-1 col-sm-4'>Comuna</label>
                <div class='col-sm-6'>
                <input type='text' id='comuna' class='form-control' value='$datos[comuna_usr]'>
                </div>
            </div>
                
                ";
            }
            ?>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <input type="button" class="btn btn-success" id="guardar" value="Guardar">
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