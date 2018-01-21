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
    <title>Inicio Director</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script>
        function ver_alumno(ref) {
            window.location.href = "ver_alumno_dir.php?id="+ref;
        }
    </script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_director.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <?php
            $sql = "SELECT * FROM curso
                INNER JOIN lista ON curso.id_curso = lista.id_curso
                INNER JOIN alumno ON lista.id_alumno = alumno.id_alumno
                INNER JOIN usuario ON alumno.rut_usr = usuario.rut_usr
                WHERE curso.id_curso = $_GET[curso]";
            $res = $dbcon->query($sql);

            $sql3 = "SELECT * FROM curso
                  WHERE curso.id_curso = $_GET[curso]";
            $res3 = $dbcon->query($sql3);
            while($datos3 = mysqli_fetch_array($res3)){
                echo"<h3>$datos3[nombre_curso]</h3>";
            }

            echo"<table class='table table-borderer table-responsive'>
                <thead>
                <tr>
                    <td style='border: #34a9b6 2px solid;'><label>Alumno</label></td>
                    <td style='border: #34a9b6 2px solid;'><label>% Asistencia</label></td>
                    <td style='border: #34a9b6 2px solid;'><label>Promedio</label></td>
                    <td style='border: #34a9b6 2px solid;'><label>Ver</label></td>
                </tr>
                </thead>
                <tbody>";

            $anio = DATE('Y');
            $date = "$anio-01-01";

            while($datos = mysqli_fetch_array($res)){
                echo"
        <tr>
            <td style='border: #34a9b6 2px solid;'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
            <td style='border: #34a9b6 2px solid;'>";
                $sql2 = "SELECT * FROM asistencia WHERE id_alumno = $datos[id_alumno] AND fecha > '$date' AND fecha <= NOW()";
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
            <td style='border: #34a9b6 2px solid;'>";
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

                $general2 = number_format($general, 1, '.', ',');

                echo"$general2";
                echo"</td>
                <td style='border: #34a9b6 2px solid;'><input type='button' value='Ver' class='btn btn-success' onclick='ver_alumno($datos[id_alumno])'></td>
        </tr>
        ";
            }

            echo"</tbody>
            </table>";

            ?>
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