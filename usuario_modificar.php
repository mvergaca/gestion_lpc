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

    <script src="js/usuario_modificar.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <form class="form-inline col-sm-offset-3 col-sm-6" style='background-color: #f7ecb5;'>
            <?php
            $sql = "SELECT * FROM usuario
                    LEFT JOIN administrador ON administrador.rut_usr = usuario.rut_usr
                    LEFT JOIN alumno ON alumno.rut_usr = usuario.rut_usr
                    LEFT JOIN apoderado ON apoderado.rut_usr = usuario.rut_usr
                    LEFT JOIN asistente ON asistente.rut_usr = usuario.rut_usr
                    LEFT JOIN director ON director.rut_usr = usuario.rut_usr
                    LEFT JOIN profesor ON profesor.rut_usr =usuario.rut_usr
                    LEFT JOIN secretaria ON secretaria.rut_usr = usuario.rut_usr
                    LEFT JOIN utp ON utp.rut_usr = usuario.rut_usr
                    WHERE usuario.rut_usr = '$_GET[rut]'";
            $res = $dbcon -> query($sql);
            while($datos = mysqli_fetch_array($res)){
            echo"
            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='rut' class='col-sm-offset-0 col-sm-4'>Rut</label>
                <input type='text' id='rut' class='form-control' value='$_GET[rut]' disabled>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='nombre' class='col-sm-offset-0 col-sm-4'>Nombre</label>
                <input type='text' id='nombre' class='form-control' value='$datos[nombre_usr]'>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='apellido_p' class='col-sm-offset-0 col-sm-4'>Apellido Paterno</label>
                <input type='text' id='apellido_p' class='form-control' value='$datos[apellido_p_usr]'>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='apellido_m' class='col-sm-offset-0 col-sm-4'>Apellido Materno</label>
                <input type='text' id='apellido_m' class='form-control' value='$datos[apellido_m_usr]'>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='fecha_n' class='col-sm-offset-0 col-sm-4'>Fecha Nacimiento</label>
                <input type='date' id='fecha_n' class='form-control' value='$datos[fecha_n_usr]'>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='genero'>Masculino</label>
                <input type='radio' id='genero_m' name='genero' class='form-control'";if($datos["genero_usr"] == "M") {echo"checked";}; echo">
                <label for='genero'>Femenino</label>
                <input type='radio' id='genero_f' name='genero' class='form-control'";if($datos["genero_usr"] == "F") {echo"checked";}; echo">
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='telefono' class='col-sm-offset-0 col-sm-4'>Telefono</label>
                <input type='text' id='telefono' class='form-control' value='$datos[telefono_usr]'>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='correo' class='col-sm-offset-0 col-sm-4'>Correo</label>
                <input type='email' id='correo' class='form-control' value='$datos[correo_usr]'>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='direccion' class='col-sm-offset-0 col-sm-4'>Direccion</label>
                <input type='text' id='direccion' class='form-control' value='$datos[direccion_usr]'>
            </div>

            <div class=' form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='comuna' class='col-sm-offset-0 col-sm-4'>Comuna</label>
                <input type='text' id='comuna' class='form-control' value='$datos[comuna_usr]'>
            </div>

            <div class='form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='tipo_usuario' class='col-sm-offset-0 col-sm-4'>Tipo Usuario</label>
                <select id='tipo_usuario' class='form-control'>
                    <option value=''> - - - </option>
                    
                    <option value='administrador' "; if($datos["id_administrador"] != null){echo"selected";}; echo">Administrador</option>
                    
                    <option value='alumno' "; if($datos["id_alumno"] != null){echo"selected";}; echo">Alumno</option>
                    
                    <option value='apoderado' "; if($datos["id_apoderado"] != null){echo"selected";}; echo">Apoderado</option>
                    
                    <option value='asistente' "; if($datos["id_asistente"] != null){echo"selected";}; echo">Asistente</option>
                    
                    <option value='director' "; if($datos["id_director"] != null){echo"selected";}; echo">Director</option>
                    
                    <option value='profesor' "; if($datos["id_profesor"] != null){echo"selected";}; echo">Profesor</option>
                    
                    <option value='secretaria' "; if($datos["id_secretaria"] != null){echo"selected";}; echo">Secretaria</option>
                    
                    <option value='utp' "; if($datos["id_utp"] != null){echo"selected";}; echo">Utp</option>
                    
                </select>

            </div>
            ";
 }?>
            <div class="form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <input type="button" id="guardar" class="btn btn-success" value="Guardar">
            </div>

        </form>
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