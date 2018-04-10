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
    <title>Inicio Utp</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script src="js/gestionar_curso.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_utp.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">

            <?php
            $sql = "SELECT * FROM curso
                INNER JOIN lista ON curso.id_curso = lista.id_curso
                INNER JOIN alumno ON lista.id_alumno = alumno.id_alumno
                INNER JOIN usuario ON alumno.rut_usr = usuario.rut_usr
                WHERE curso.id_curso = $_GET[curso] ORDER BY usuario.nombre_usr";
            $res = $dbcon->query($sql);

            $sql3 = "SELECT * FROM curso
                  WHERE curso.id_curso = $_GET[curso]";
            $res3 = $dbcon->query($sql3);
            while($datos3 = mysqli_fetch_array($res3)){
                echo"<h3>$datos3[nombre_curso]</h3>";
            }

            echo"
            <div class='col-sm-offset-0 col-sm-12'>
                <div class='col-sm-offset-4 col-sm-1'>
                    <label>Curso</label>
                </div>
                <div class='col-sm-3' style='margin-bottom: 2%'>
                    <select id='curso' class='form-control'>
                        <option value=''> - - - </option>";
                    $sql5 = "SELECT * FROM curso";
                    $res5 = $dbcon->query($sql5);
                    while($datos5 = mysqli_fetch_array($res5)){
                        echo"<option value='$datos5[id_curso]'>$datos5[nombre_curso]</option>";
                    }
                    echo"<option value='100'>Graduar</option>";
                    echo"</select>
                </div>
            </div>

            <div class='col-sm-offset-0 col-sm-12 table-responsive'>
            <table class='table table-borderer table-responsive'>
                <thead>
                <tr>
                    <td class='col-sm-7' style='border: #34a9b6 2px solid;'><label>Alumno</label></td>
                    <td class='col-sm-2' style='border: #34a9b6 2px solid;'><label>% asistencia</label></td>
                    <td class='col-sm-1' style='border: #34a9b6 2px solid;'><label>Promedio</label></td>
                    <td class='col-sm-1' style='border: #34a9b6 2px solid;'><label>Aprobar</label></td>
                    <td class='col-sm-1' style='border: #34a9b6 2px solid;'><label>Reprobar</label></td>
                </tr>
                </thead>
                <tbody>";

            $anio = DATE('Y');
            $date = "$anio-01-01";
            while($datos = mysqli_fetch_array($res)){
                echo"
        <tr>
            <td style='border: #34a9b6 2px solid;'>
                $datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]
            </td>
            
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
                          WHERE asignatura.promediable = 0 
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
                <td style='border: #34a9b6 2px solid;'>
                <input type='button' class='btn btn-success' value='Aprobar' onclick='aprobar($datos[id_alumno])'>

                </td>
                <td style='border: #34a9b6 2px solid;'>
                <input type='button' class='btn btn-danger' value='Reprobar' onclick='reprobar($datos[id_alumno])'>
                
                </td>
        </tr>
        ";
            }

            echo"</tbody>
            </table>
            </div>
            <div class='col-sm-offset-0 col-sm-12' style='margin-bottom: 1%'>
                
            </div>
            ";
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