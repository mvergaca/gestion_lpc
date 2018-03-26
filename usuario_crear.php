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

    <script src="js/usuario_crear.js"></script>

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

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="rut" class="col-sm-offset-0 col-sm-4">Rut</label>
            <input type="text" id="rut" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="nombre" class="col-sm-offset-0 col-sm-4">Nombre</label>
            <input type="text" id="nombre" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="apellido_p" class="col-sm-offset-0 col-sm-4">Apellido Paterno</label>
            <input type="text" id="apellido_p" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="apellido_m" class="col-sm-offset-0 col-sm-4">Apellido Materno</label>
            <input type="text" id="apellido_m" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="fecha_n" class="col-sm-offset-0 col-sm-4">Fecha Nacimiento</label>
            <input type="date" id="fecha_n" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="genero">Masculino</label>
            <input type="radio" id="genero_m" name="genero" class="form-control">
            <label for="genero">Femenino</label>
            <input type="radio" id="genero_f" name="genero" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="telefono" class="col-sm-offset-0 col-sm-4">Telefono</label>
            <input type="text" id="telefono" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="correo" class="col-sm-offset-0 col-sm-4">Correo</label>
            <input type="email" id="correo" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="direccion" class="col-sm-offset-0 col-sm-4">Direccion</label>
            <input type="text" id="direccion" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="comuna" class="col-sm-offset-0 col-sm-4">Comuna</label>
            <input type="text" id="comuna" class="form-control">
        </div>

        <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <label for="tipo_usuario" class="col-sm-offset-0 col-sm-4">Tipo Usuario</label>
            <select id="tipo_usuario" class="form-control">
                <option value=""> - - - </option>

                <option value="administrador">Administrador</option>
                <option value="alumno">Alumno</option>
                <option value="apoderado">Apoderado</option>
                <option value="asistente">Asistente</option>
                <option value="director">Director</option>
                <option value="inspector">Inspector</option>
                <option value="profesor">Profesor</option>
                <option value="secretaria">Secretaria</option>
                <option value="utp">Utp</option>
            </select>

        </div>

        <div class="form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <input type="button" id="guardar" class="btn btn-success" value="Guardar" style="margin-bottom: 2%">
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