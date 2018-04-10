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
    <title>Inicio Apoderado</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">



</head>
<body>

<section id="encabezado">
    <?php
    include "head_apoderado.php";
    ?>
</section>

<section id="principal">
    <div   class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <?php
            $sql = "SELECT * FROM alumno
                    INNER JOIN usuario ON alumno.rut_usr = usuario.rut_usr
                    WHERE id_alumno = $_GET[id]";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"<h4>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</h4>";
            }
            $res->close();

            echo"<table class='table table-bordered table-responsive'>";

            $sql2 = "SELECT * FROM semestre WHERE anio = YEAR(NOW()) ORDER BY nombre_sem";
            $res2 = $dbcon->query($sql2);
            while ($datos2 = mysqli_fetch_array($res2)){
                echo"<tr>
                    <td>
                        <h4>$datos2[nombre_sem]</h4>";

                $sql3 = "SELECT * FROM asignatura
                          INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                          INNER JOIN curso ON curso.id_curso = clase.id_curso
                          INNER JOIN lista ON lista.id_curso = curso.id_curso
                          INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                          WHERE alumno.id_alumno = $_GET[id] ORDER BY asignatura.nombre_asignatura";
                $res3 = $dbcon->query($sql3);

                echo"
                        <table class='table table-bordered table-responsive'>
                            <thead>
                            <tr>
                                <td class='col-sm-3'><label>Asignatura</label></td>
                                <td class='col-sm-8'><label>Notas</label></td>
                                <td class='col-sm-1'><label>Promedio</label></td>
                            </tr>
                            </thead>
                            <tbody>";
                while ($datos3 = mysqli_fetch_array($res3)){
                    echo"<tr>
                                        <td>$datos3[nombre_asignatura]</td>
                                        <td>
                                            <table class='table table-bordered table-responsive'>
                                            <tr>";
                    $sql4 = "SELECT nota FROM nota 
                                                  WHERE id_alumno = $_GET[id] AND id_asignatura = $datos3[id_asignatura]
                                                  AND id_semestre = $datos2[id_semestre]";
                    $res4 = $dbcon->query($sql4);
                    $notas = array(null,null,null,null,null,null,null,null,null,null);
                    $i = 0;

                    while($datos4 = mysqli_fetch_array($res4)){
                        $notas[$i] = $datos4['nota'];
                        $i++;
                    }

                    $suma = 0;
                    $num_notas = 0;

                    for($j = 0; $j < 10; $j++){
                        if($notas[$j] != null) {
                            echo "<td class='col-sm-1'>$notas[$j]</td>";
                            $suma = $suma + $notas[$j];
                            $num_notas++;

                        }
                        else{
                            echo "<td class='col-sm-1'></td>";
                        }
                    }

                    if($num_notas == 0){
                        $num_notas = 1;
                    }
                    $prom = $suma/$num_notas;

                    echo"</tr></table>
                                        </td>
                                        <td><table class='table table-bordered'><tr><td>$prom</td></tr></table></td>
                                    </tr>";
                }

                echo"</tbody>
                        </table>
                      
                    </td>
                </tr>";
            }

            echo"</table>";
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