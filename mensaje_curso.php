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

    <script src="js/mensaje_curso.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_profesor.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <h3>Mensaje al Curso</h3>
        <?php
        $curso = $_GET['curso'];
        $asignatura = $_GET['asigna'];

        $sql = "SELECT * FROM profesor
                WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
        $res = $dbcon ->query($sql);
        while ($dato = mysqli_fetch_array($res)){
            $profesor = $dato['id_profesor'];
        }
        ?>
        <input type="hidden" id="prof" value="<?php echo"$profesor";?>">
        <input type="hidden" id="asignatura" value="<?php echo"$asignatura";?>">

        <div class="col-sm-offset-0 col-sm-12" style="margin: 1%">
            <label class="col-sm-offset-4 col-sm-1">Cursos</label>
            <div class="col-sm-4">
            <select id="cursos" class="form-control">
                <?php
                $sql2 = "SELECT DISTINCT curso.id_curso, curso.nombre_curso, asignatura.nombre_asignatura FROM curso
                      INNER JOIN clase ON clase.id_curso = curso.id_curso 
                      INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor 
                      INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                      WHERE clase.id_profesor = $profesor AND clase.id_curso = $curso AND asignatura.id_asignatura = $asignatura";
                $res2 = $dbcon->query($sql2);
                while($datos2 = mysqli_fetch_array($res2)){
                    echo"<option value='$datos2[id_curso]'>$datos2[nombre_asignatura] $datos2[nombre_curso]</option>";
                }
                ?>
            </select>
            </div>
        </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin: 1%">
                <label class="col-sm-offset-4 col-sm-1">Fecha</label>
                <div class="col-sm-4">
                    <input id="fecha" type="date" class="form-control">
                </div>
            </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin: 1%">
            <textarea id="mensaje" class="form-control" style="height: 200px"></textarea>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin: 1%">
            <input type="button" id="guardar" value="Guardar" class="btn btn-info">
        </div>

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