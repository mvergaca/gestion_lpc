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

    <script src="css/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>

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
    <?php
    $con = "select * from curso 
            INNER JOIN clase ON clase.id_curso = curso.id_curso
            INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
            WHERE curso.id_curso = $_GET[curso] AND asignatura.id_asignatura = $_GET[asi]";
    $res_con = $dbcon->query($con);
    while ($dat = mysqli_fetch_array($res_con)){
         $nombre_cur = $dat['nombre_asignatura'];
         $nombre_asi = $dat['nombre_curso'];
    }
    $res_con->close();
    $dia = date('Y');
    $año="$dia-01-01 00:00:00";
    ?>
    <div class="col-sm-offset-2 col-sm-8"  style="background-color: #f7ecb5;">

        <?php echo"<h3>$nombre_cur $nombre_asi</h3>";?>
        <table id="ingresar" class="table table-bordered table-responsive">
            <thead>
            <tr>
                <td align="center" style='border: #34a9b6 2px solid;'><b>Alumnos</b></td>
                <td align="center" style='border: #34a9b6 2px solid;'><b>% Asistencia</b></td>
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
                <td align='center' style='border: #34a9b6 2px solid;'>";
                    $sql2 ="SELECT * FROM asistencia WHERE id_alumno = $datos[id_alumno] AND id_asignatura = $_GET[asi] AND fecha_hora > '$año'";
                    $res2 = $dbcon->query($sql2);
                    $asis = 0;
                    $total = 0;
                    while ($datos2 = mysqli_fetch_array($res2)){
                        if($datos2['estado'] == 1){
                            $asis = $asis+1;
                        }
                        $total = $total+1;
                    }
                if($total < 1){
                    $total = 1;
                }
                    $por = ($asis * 100)/$total;

                    echo round($por)."%";
                echo"</td>
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