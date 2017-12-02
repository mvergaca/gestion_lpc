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
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-3 col-sm-6" style="background-color: #f7ecb5;">
    <?php
    $con = "select profesor.id_profesor from profesor 
            INNER JOIN curso ON curso.id_profesor = profesor.id_profesor
            WHERE curso.id_curso = $_GET[curso]";
    $res_con = $dbcon->query($con);
    while ($dat = mysqli_fetch_array($res_con)){
        $id_profe = $dat['id_profesor'];
    }
    $res_con->close();
    ?>
    <input type="hidden" id="usuario" value="<?php echo"$id_profe";?>">
            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="asignatura" class="col-sm-offset-3 col-sm-2">Asignatura</label>
                <div class="col-sm-4">
                    <select id="asignatura" class="form-control">
                        <option value=""> - - - </option>
                        <?php
                        $sql="SELECT * FROM asignatura
                              INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                              INNER JOIN curso ON curso.id_curso = clase.id_curso
                              WHERE curso.id_curso = $_GET[curso]";
                        $res = $dbcon->query($sql);
                        while ($datos = mysqli_fetch_array($res)){
                            echo"<option style='font-size: 12px' value='$datos[id_asignatura]'>$datos[nombre_asignatura]</option>";
                        }
                        $res->close();
                        ?>
                    </select>
                </div>
            </div>
    <div class="col-sm-offset-0 col-sm-12" style="margin-top: 7px">
        <table id="ingresar" class="table table-bordered table-responsive" >
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
        <input type="button" id="guardar" class="btn btn-info" value="Guardar" style="margin: 5px"><br>
    </div>
        </div>
    </div>
</section>

<section id="pie"  class="col-sm-offset-0 col-sm-12">
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