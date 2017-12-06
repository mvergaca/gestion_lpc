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
    <title>Inicio Profesor</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="css/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css">
    <script src="css/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <script src="js/tomar_asistencia.js" type="text/javascript"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_profesor.php";
    ?>
</section>

<section id="principal">
    <?php
    $con = "select id_profesor from profesor WHERE rut_usr = '$_SESSION[rut_usr]'";
    $res_con = $dbcon->query($con);
    while ($dat = mysqli_fetch_array($res_con)){
        $id_profe = $dat['id_profesor'];
    }
    $res_con->close();
    ?>
<input type="hidden" id="usuario" value="<?php echo"$id_profe";?>">
<input type="hidden" id="asignatura" value="<?php echo"$_GET[asig]";?>">
    <input type="hidden" id="curso" value="<?php echo"$_GET[curso]";?>">
    <div align="center">
        <table id="ingresar" class="table-bordered table-responsive" style="background-color: #f7ecb5;">
            <thead>
            <tr>
                <td align="center" style='border: #34a9b6 2px solid;'><b>Alumno</b></td>
                <td align="center" style='border: #34a9b6 2px solid;'><b>Presente</b></td>
            </tr>
            </thead>
    <?php
    $id_curso = $_GET["curso"];

    $sql ="SELECT * FROM lista 
           INNER JOIN curso ON lista.id_curso = curso.id_curso
           INNER JOIN alumno ON lista.id_alumno = alumno.id_alumno
           INNER JOIN usuario ON alumno.rut_usr = usuario.rut_usr
           WHERE curso.id_curso = $id_curso ORDER BY usuario.nombre_usr";
    $res = $dbcon->query($sql);
    $i = 1;
    while ($datos = mysqli_fetch_array($res)){
        echo"
            <tr><input type='hidden' id='id_estudiante_$i' value='$datos[id_alumno]'>
                <td align='center' style='border: #34a9b6 2px solid;'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                <td align='center' style='border: #34a9b6 2px solid;'><input type='checkbox' id='asistencia_$i' name='check' checked></td>
            </tr>
        ";
        $i++;
    }
    $res->close();
    ?>
        </table><br>
        <input type="button" id="guardar" class="btn btn-info" value="Guardar" onclick=""><br>
    </div>
</section><br>

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