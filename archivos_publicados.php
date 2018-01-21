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
    <link rel="stylesheet" type="text/css" href="css/estilos.css">


</head>
<body>

<section id="encabezado">
    <?php
    include "head_profesor.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">
            <?php
               $sql3 = "SELECT * FROM clase
                        INNER JOIN curso ON clase.id_curso = curso.id_curso
                        INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                        WHERE curso.id_curso = $_GET[curso] AND asignatura.id_asignatura = $_GET[asigna]";
               $res3 = $dbcon->query($sql3);
               while($datos3 = mysqli_fetch_array($res3)){
                   echo"<h3>Material $datos3[nombre_asignatura] $datos3[nombre_curso]</h3>";
               }
               $res3->close();
            ?>
            <table class="table table-responsive table-bordered">
                <thead>
                <tr>
                    <td class="col-sm-2"><label>Fecha</label></td>
                    <td class="col-sm-7"><label>Detalle</label></td>
                    <td class="col-sm-3"><label>Descargar</label></td>
                </tr>
                </thead>
                <tbody>
            <?php
            $anio = date("Y");
            $fecha = $anio."-01-01";
            $sql = "SELECT * FROM material_estudiantil
                    INNER JOIN profesor ON profesor.id_profesor = material_estudiantil.id_profesor
                    WHERE profesor.rut_usr = '$_SESSION[rut_usr]' AND material_estudiantil.fecha >= '$fecha'";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"
                <tr>
                    <td>$datos[fecha]</td>
                    <td>$datos[detalle]</td>
                    <td><a href='descargar_archivo.php?ref=$datos[dir_material]'><button class='btn btn-info'>Descargar</button></a></td>
                </tr>
                ";
            }
            $res->close();
            ?>
                </tbody>
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