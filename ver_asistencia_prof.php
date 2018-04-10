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
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <?php
            $sql = "SELECT * FROM curso WHERE id_curso = $_GET[curso]";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
               $curso = $datos["nombre_curso"];
               echo"<input type='hidden' id='curso' value='$_GET[curso]'>";
            }

            $sql4 = "SELECT * FROM asignatura WHERE id_asignatura = $_GET[asi]";
            $res4 = $dbcon -> query($sql4);
            while($datos4 = mysqli_fetch_array($res4)){
                $asignatura = $datos4["nombre_asignatura"];
                echo"<input type='hidden' id='asig' value='$_GET[asi]'>";
            }

            echo"<h4>$asignatura $curso</h4>";
            ?>

            <div class="col-sm-offset-0 col-sm-12">
                <div class="col-sm-offset-1 col-sm-10" id="asistencia">
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <td class="col-sm-10"><label>Alumno</label></td>
                            <td class="col-sm-2"><label>Estado</label></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql3 = "SELECT * FROM lista
                                INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                                WHERE lista.anio = YEAR(NOW()) AND lista.id_curso = $_GET[curso]
                                ORDER BY usuario.nombre_usr";
                        $res3 = $dbcon->query($sql3);
                        while($datos3 = mysqli_fetch_array($res3)){
                            echo"
                            <tr>
                            <td>$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</td>
                            <td>";

                            $sql2 = "SELECT * FROM asistencia
                                    WHERE id_asignatura = $_GET[asi] AND id_alumno = $datos3[id_alumno] 
                                    AND fecha = CURRENT_DATE() order by id_asistencia asc limit 1";
                            $res2 = $dbcon->query($sql2);
                            $estado = "";
                            if(mysqli_num_rows($res2) < 1){
                                echo"<span class=\"glyphicon glyphicon-minus\" aria-hidden=\"true\"></span>";
                            }
                            while($datos2 = mysqli_fetch_array($res2)){
                                if($datos2["estado"] == 0){
                                    echo"<span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>";
                                }
                                else{
                                    if($datos2["estado"] == 1){
                                        echo"<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
                                    }
                                }

                            }

                            echo"</td>
                            </tr>
                            ";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
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