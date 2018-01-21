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
</head>
<body>

<section id="encabezado">
    <?php
    include "head_director.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <h3>Datos del profesor</h3>
            <?php
            $sql="SELECT * FROM profesor
                      INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                      WHERE profesor.id_profesor = $_GET[id]";
            $res=$dbcon->query($sql);
            while($datos=mysqli_fetch_array($res)){
                $rut = $datos['rut_usr'];
                $nombre = $datos['nombre_usr'];
                $apellido_p = $datos['apellido_p_usr'];
                $apellido_m = $datos['apellido_m_usr'];
                $fecha_n = $datos['fecha_n_usr'];
                $genero = $datos['genero_usr'];
                $telefono = $datos['telefono_usr'];
                $correo = $datos['correo_usr'];
                $direccion = $datos['direccion_usr'];
                $comuna = $datos['comuna_usr'];
            }

            echo"
            <div class='col-sm-offset-2 col-sm-8'>
                <table class='table table-responsive table-bordered'>
                    <tr>
                        <td><label>Rut</label></td>
                        <td>$rut</td>
                    </tr>
                    <tr>
                        <td><label>Nombre</label></td>
                        <td>$nombre</td>
                    </tr>
                    <tr>
                        <td><label>Apellido Paterno</label></td>
                        <td>$apellido_p</td>
                    </tr>
                    <tr>
                        <td><label>Apellido Materno</label></td>
                        <td>$apellido_m</td>
                    </tr>
                    <tr>
                        <td><label>Fecha nacimiento</label></td>
                        <td>$fecha_n</td>
                    </tr>
                    <tr>
                        <td><label>Genero</label></td>
                        <td>$genero</td>
                    </tr>
                    <tr>
                        <td><label>Telefono</label></td>
                        <td>$telefono</td>
                    </tr>
                    <tr>
                        <td><label>Correo</label></td>
                        <td>$correo</td>
                    </tr>
                    <tr>
                        <td><label>Direccion</label></td>
                        <td>$direccion</td>
                    </tr>
                    <tr>
                        <td><label>Comuna</label></td>
                        <td>$comuna</td>
                    </tr>
                </table>
            </div>
                ";

            ?>

        </div>

        <div id="horario" class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <h2>Horario</h2>
            <table id="tabla-horario" class="table table-responsive table-bordered">
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
                        $sql = "SElECT * FROM horario
                     LEFT JOIN distribucion ON horario.id_horario = distribucion.id_horario
                     LEFT JOIN clase ON distribucion.id_clase = clase.id_clase
                     LEFT JOIN profesor ON clase.id_profesor = profesor.id_profesor
                     LEFT JOIN curso ON clase.id_curso = curso.id_curso
                     LEFT JOIN asignatura ON clase.id_asignatura = asignatura.id_asignatura
                     WHERE profesor.rut_usr = '$rut' AND horario.id_horario = $datos2[id_horario] AND distribucion.dia = '$dias[$i]' ORDER BY horario.id_horario";
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