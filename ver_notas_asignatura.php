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
    <div align="center">
        <?php
        $curso = $_GET["curso"];
        $sql = "SELECT * FROM usuario
        INNER JOIN alumno ON alumno.rut_usr = usuario.rut_usr
        INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
        INNER JOIN curso ON curso.id_curso = lista.id_curso
        WHERE curso.id_curso = $curso";

        $res = $dbcon->query($sql);

        $sql3 = "SELECT * FROM curso
                  INNER JOIN clase ON clase.id_curso = curso.id_curso
                  INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                  WHERE curso.id_curso = $_GET[curso] AND asignatura.id_asignatura = $_GET[asig]";
        $res3 = $dbcon->query($sql3);
        while($datos3 = mysqli_fetch_array($res3)){
            $cur = $datos3["nombre_curso"];
            $asi = $datos3["nombre_asignatura"];
        }


        echo"<label><h3>$asi - $cur</h3></label>
            <table id='ver_notas' class='table-bordered table-responsive' style='background: #f7ecb5;'>
                <thead>
                <tr>
                    <td align='center'><b>Alumno</b></td>
                                      
                </tr>
                </thead>";
        while ($datos = mysqli_fetch_array($res)){
            echo"<tr>
                <td align='center'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>";

            $sql2 = "SELECT * FROM nota
                    WHERE nota.id_alumno = $datos[id_alumno]";
            $res2 = $dbcon->query($sql2);
            $suma = 0;
            $can = mysqli_num_rows($res2);if($can == 0)$can=1;
            while ($datos2 = mysqli_fetch_array($res2)){
                echo"<td align='center' style='width: 30px'>$datos2[nota]</td>";
                $suma = $suma + $datos2['nota'];
            }
            $div = $suma/$can;
            $prom = number_format($div,1,".",",");
            echo"<td align='center' style='width: 30px; background: greenyellow' >$prom</td>
            </tr>";
        }
        $res->close();
        echo"</table>"
        ?>
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