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
</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal" style="min-height: 540px;">
    <div class="col-sm-offset-0 col-sm-12">
    <div id="horario" class="col-sm-offset-1 col-sm-10" style='background-color: #f7ecb5;'>
        <?php
        $sql3 = "SELECT * FROM usuario 
                  LEFT JOIN profesor ON profesor.rut_usr = usuario.rut_usr
                  LEFT JOIN alumno ON alumno.rut_usr = usuario.rut_usr
                  WHERE usuario.rut_usr = '$_GET[rut]'";
        $res3 = $dbcon -> query($sql3);
        while($datos3 = mysqli_fetch_array($res3)){
            $nombre = $datos3["nombre_usr"];
            $apellido_p = $datos3["apellido_p_usr"];
            $apellido_m = $datos3["apellido_m_usr"];
            $prof = $datos3["id_profesor"];
            $alu = $datos3["id_alumno"];
        }
        echo"<h4>Horario de $nombre $apellido_p $apellido_m</h4>";
        ?>
        <table id="tabla-horario" class=" table table-responsive table-bordered">
            <thead>
            <tr>
                <td style="width: 20%"><b>Horario</b></td>
                <td style="width: 16%"><b>Lunes</b></td>
                <td style="width: 16%"><b>Martes</b></td>
                <td style="width: 16%"><b>Miércoles</b></td>
                <td style="width: 16%"><b>Jueves</b></td>
                <td style="width: 16%"><b>Viernes</b></td>
            </tr>
            </thead>
            <?php
            $dias = array(1 => "lunes",2 => "martes",3 => "miercoles",4 => "jueves",5 => "viernes");

            $sql2 = "SELECT * FROM horario";
            $res2 = $dbcon->query($sql2);

            while($datos2 = mysqli_fetch_array($res2)) {
                echo "<tr>";
                echo "<td>$datos2[hora_inicio] - $datos2[hora_fin] </td>";

            for($i = 1; $i<=5; $i++) {
                if($prof != null) {
                    $sql = "SElECT * FROM horario
                     LEFT JOIN distribucion ON horario.id_horario = distribucion.id_horario
                     LEFT JOIN clase ON distribucion.id_clase = clase.id_clase
                     LEFT JOIN profesor ON clase.id_profesor = profesor.id_profesor
                     LEFT JOIN curso ON clase.id_curso = curso.id_curso
                     LEFT JOIN asignatura ON clase.id_asignatura = asignatura.id_asignatura
                     WHERE profesor.rut_usr = '$_GET[rut]' AND horario.id_horario = $datos2[id_horario] AND distribucion.dia = '$dias[$i]' ORDER BY horario.id_horario";
                }
                else{
                    $sql = "SElECT * FROM horario
                     LEFT JOIN distribucion ON horario.id_horario = distribucion.id_horario
                     LEFT JOIN clase ON distribucion.id_clase = clase.id_clase
                     LEFT JOIN curso ON clase.id_curso = curso.id_curso
                     LEFT JOIN lista ON lista.id_curso = curso.id_curso
                     LEFT JOIN alumno ON alumno.id_alumno = lista.id_alumno
                     LEFT JOIN asignatura ON clase.id_asignatura = asignatura.id_asignatura
                     WHERE alumno.rut_usr = '$_GET[rut]' AND horario.id_horario = $datos2[id_horario] AND distribucion.dia = '$dias[$i]' ORDER BY horario.id_horario";
                }
                $res = $dbcon->query($sql) or die("no se pudo mostrar horario" . mysqli_error());

                if(mysqli_num_rows($res) > 0){
                    while ($datos = mysqli_fetch_array($res)) {
                        echo "<td>$datos[nombre_asignatura] - $datos[nombre_curso]</td>";
                    }
                }
                else{
                    echo "<td>-</td>";
                }

                $res->close();
            }
                echo "</tr>";
            }
            $res2 ->close();
            ?>
        </table><br><br>
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