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

    <script src="js/ver_lista.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div   class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <?php
            echo"<input type='hidden' id='curso' value='$_GET[id]'>";
            $sql2 = "SELECT * FROM curso WHERE id_curso = $_GET[id]";
            $res2 = $dbcon->query($sql2);
            while($datos2 = mysqli_fetch_array($res2)){
                echo"<h3>$datos2[nombre_curso]</h3>";
            }
            $res2->close();
            ?>
            <table class="table table-bordered table-responsive" >
                <thead>
                <tr>
                    <td style="border: #34a9b6 2px solid;"><label>Alumno</label></td>
                    <td style="border: #34a9b6 2px solid;"><label>Ver</label></td>
                </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM lista 
                INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                INNER JOIN curso ON curso.id_curso = lista.id_curso
                INNER JOIN establecimiento ON establecimiento.id_establecimiento = curso.id_establecimiento
                WHERE curso.id_curso = $_GET[id] ORDER BY usuario.nombre_usr";
                $res = $dbcon->query($sql);
                while ($datos = mysqli_fetch_array($res)){
                    echo"
            <tr>
                <td style='border: #34a9b6 2px solid;'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>   
                <td style='border: #34a9b6 2px solid;'><input type='button' class='btn btn-success' value='Ver' onclick='ver_alumno($datos[id_alumno]);'></td>         
            </tr>
            ";
                }

                ?>
            </table>
        </div>
        <div class="col-sm-offset-2 col-sm-8">
            <?php
            if(mysqli_num_rows($res)>0) {
                echo "<input type=\"button\" class=\"btn btn-success\" id=\"asistencia\" value=\"Tomar asistencia\">";
            }
            $res->close();
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