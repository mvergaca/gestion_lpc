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
        <div class="col-sm-offset-2 col-sm-8">
        <?php
        $sql = "SELECT * FROM curso
                INNER JOIN profesor ON curso.id_profesor = profesor.id_profesor
                INNER JOIN lista ON curso.id_curso = lista.id_curso
                INNER JOIN alumno ON lista.id_alumno = alumno.id_alumno
                INNER JOIN usuario ON alumno.rut_usr = usuario.rut_usr
                WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
        $res = $dbcon->query($sql);

        $sql3 = "SELECT * FROM curso
                  INNER JOIN profesor ON profesor.id_profesor = curso.id_profesor
                  WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
        $res3 = $dbcon->query($sql3);
        while($datos3 = mysqli_fetch_array($res3)){
            echo"<h3>$datos3[nombre_curso]</h3>";
        }

        echo"<table class='table table-borderer table-responsive' style='background-color: #f7ecb5;'>
                <thead>
                <tr>
                    <td><label>Alumno</label></td>
                    <td><label>% Asistencia</label></td>
                    <td><label>Promedio</label></td>
                </tr>
                </thead>
                <tbody>";

        while($datos = mysqli_fetch_array($res)){
        echo"
        <tr>
            <td><a href='ver_alumno.php?id=$datos[id_alumno]'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</a></td>
            <td>";
                $sql2 = "SELECT * FROM asistencia WHERE id_alumno = $datos[id_alumno] AND fecha_hora > '2017-01-01 00:00:00' AND fecha_hora <= NOW()";
                $res2 = $dbcon->query($sql2);

                $total = 0;
                $asistido = 0;
                while($datos2 = mysqli_fetch_array($res2)){
                    if($datos2['estado'] == 1){
                        $asistido = $asistido + 1;
                    }
                    $total = $total + 1;
                }
                if($total == 0){
                    $total = 1;
                }
                $por = ($asistido * 100)/$total;
                echo round($por)."%";

        echo"</td>
            <td>";
                $sql4 = "SELECT * FROM nota
                          INNER JOIN alumno ON alumno.id_alumno = nota.id_alumno
                          INNER JOIN asignatura ON asignatura.id_asignatura = nota.id_asignatura
                          INNER JOIN semestre ON semestre.id_semestre = nota.id_semestre
                          WHERE (asignatura.id_asignatura <> 14 OR asignatura.id_asignatura <> 15 OR asignatura.id_asignatura <> 16 OR asignatura.id_asignatura <> 12) 
                          AND alumno.id_alumno = $datos[id_alumno] AND semestre.anio = YEAR(NOW())";

                $res4 = $dbcon->query($sql4);

                $suma = 0;
                $num = 0;
                while($datos4 = mysqli_fetch_array($res4)){
                    $suma = $suma + $datos4['nota'];
                    $num = $num +1;
                }

                if($num == 0){
                    $num = 1;
                }

                $general = ($suma /$num);

                $general2 = number_format($general, 2, '.', ',');

                echo"$general2";
        echo"</td>
        </tr>
        ";
        }

        echo"</tbody>
            </table>";

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