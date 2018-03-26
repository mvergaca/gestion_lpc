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

    <script src="js/cursos_ver.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div   class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8 table-responsive">
        <table class="table table-bordered table-responsive" style="background-color: #f7ecb5;">
            <thead>
            <tr>
                <td style="border: #34a9b6 2px solid;"><label>Nombre Curso</label></td>
                <td style="border: #34a9b6 2px solid;"><label>Profesor Jefe</label></td>
                <td style="border: #34a9b6 2px solid;"><label>Ver</label></td>
                <td style="border: #34a9b6 2px solid;"><label>Editar</label></td>
                <td style="border: #34a9b6 2px solid;"><label>Eliminar</label></td>
            </tr>
            </thead>
        <?php
        $sql = "SELECT * FROM curso 
                INNER JOIN profesor ON profesor.id_profesor = curso.id_profesor
                INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                INNER JOIN establecimiento ON establecimiento.id_establecimiento = curso.id_establecimiento";
        $res = $dbcon->query($sql);
        $i = 1;
        while ($datos = mysqli_fetch_array($res)){
            echo"
            <tr id='fila_$i'>
                <td style='border: #34a9b6 2px solid;'>$datos[nombre_curso]</td>
                <td style='border: #34a9b6 2px solid;'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                <td style='border: #34a9b6 2px solid;'><input type='button' class='btn btn-success' value='Ver' onclick='ver_lista($datos[id_curso]);'></td>
                <td style='border: #34a9b6 2px solid;'><input type='button' class='btn btn-info' value='Editar' onclick='editar_curso($datos[id_curso]);'></td>
                <td style='border: #34a9b6 2px solid;'><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_curso($datos[id_curso], $i);'></td>
            </tr>
            ";
            $i++;
        }
        $res->close();
        ?>
        </table>
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