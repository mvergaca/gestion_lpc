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
    <div   class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <h3>Informacion del alumno</h3>
            <div class="col-sm-offset-2 col-sm-8">
                <?php
                $sql = "SELECT * FROM usuario
                        INNER JOIN alumno ON alumno.rut_usr = usuario.rut_usr
                        WHERE alumno.id_alumno = $_GET[id]";

                $res = $dbcon->query($sql);

                while($datos = mysqli_fetch_array($res)){
                    $rut_al = $datos['rut_usr'];
                    $nombre_al = $datos['nombre_usr'];
                    $apellido_p_al = $datos['apellido_p_usr'];
                    $apellido_m_al = $datos['apellido_m_usr'];
                    $fecha_n_al = $datos['fecha_n_usr'];
                    $genero_al = $datos['genero_usr'];
                    $telefono_al = $datos['telefono_usr'];
                    $correo_al = $datos['correo_usr'];
                    $direccion_al = $datos['direccion_usr'];
                    $comuna_al = $datos['comuna_usr'];

                }
                $res->close();
                echo"
                <table class='table table-bordered table-responsive'>
                    <tr>
                        <td class='col-sm-4'><label>Rut</label></td>
                        <td class='col-sm-8'>$rut_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Nombre</label></td>
                        <td class='col-sm-8'>$nombre_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Apellido paterno</label></td>
                        <td class='col-sm-8'>$apellido_p_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Apellido materno</label></td>
                        <td class='col-sm-8'>$apellido_m_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Fecha nacimiento</label></td>
                        <td class='col-sm-8'>$fecha_n_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Genero</label></td>
                        <td class='col-sm-8'>$genero_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Telefono</label></td>
                        <td class='col-sm-8'>$telefono_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Correo</label></td>
                        <td class='col-sm-8'>$correo_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Direccion</label></td>
                        <td class='col-sm-8'>$direccion_al</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Comuna</label></td>
                        <td class='col-sm-8'>$comuna_al</td>
                    </tr>
                </table>
                ";
                ?>

                <h3>Informacion del apoderado</h3>
                <?php
                $sql2 = "SELECT * FROM alumno
                        INNER JOIN apoderado ON apoderado.id_apoderado = alumno.id_apoderado
                        INNER JOIN usuario ON usuario.rut_usr = apoderado.rut_usr
                        WHERE alumno.id_alumno = $_GET[id]";

                $res2 = $dbcon->query($sql2);

                $rut_ap = null;
                $nombre_ap = null;
                $apellido_p_ap = null;
                $apellido_m_ap = null;
                $fecha_n_ap = null;
                $genero_ap = null;
                $telefono_ap = null;
                $correo_ap = null;
                $direccion_ap = null;
                $comuna_ap = null;

                while($datos2 = mysqli_fetch_array($res2)){
                    $rut_ap = $datos2['rut_usr'];
                    $nombre_ap = $datos2['nombre_usr'];
                    $apellido_p_ap = $datos2['apellido_p_usr'];
                    $apellido_m_ap = $datos2['apellido_m_usr'];
                    $fecha_n_ap = $datos2['fecha_n_usr'];
                    $genero_ap = $datos2['genero_usr'];
                    $telefono_ap = $datos2['telefono_usr'];
                    $correo_ap = $datos2['correo_usr'];
                    $direccion_ap = $datos2['direccion_usr'];
                    $comuna_ap = $datos2['comuna_usr'];

                }
                $res2->close();



                echo"
                <table class='table table-bordered table-responsive'>
                    <tr>
                        <td class='col-sm-4'><label>Rut</label></td>
                        <td class='col-sm-8'>$rut_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Nombre</label></td>
                        <td class='col-sm-8'>$nombre_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Apellido paterno</label></td>
                        <td class='col-sm-8'>$apellido_p_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Apellido materno</label></td>
                        <td class='col-sm-8'>$apellido_m_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Fecha nacimiento</label></td>
                        <td class='col-sm-8'>$fecha_n_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Genero</label></td>
                        <td class='col-sm-8'>$genero_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Telefono</label></td>
                        <td class='col-sm-8'>$telefono_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Correo</label></td>
                        <td class='col-sm-8'>$correo_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Direccion</label></td>
                        <td class='col-sm-8'>$direccion_ap</td>
                    </tr>
                    <tr>
                        <td class='col-sm-4'><label>Comuna</label></td>
                        <td class='col-sm-8'>$comuna_ap</td>
                    </tr>
                </table>
                ";
                ?>

            </div>
            <div class="col-sm-offset-0 col-sm-12">
                <h3>Horario</h3>

                <table id="tabla-horario" class="table-responsive table-bordered">
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
                     LEFT JOIN curso ON clase.id_curso = curso.id_curso
                     LEFT JOIN lista ON lista.id_curso = curso.id_curso
                     LEFT JOIN alumno ON alumno.id_alumno = lista.id_alumno
                     LEFT JOIN asignatura ON clase.id_asignatura = asignatura.id_asignatura
                     WHERE alumno.rut_usr = '$rut_al' AND horario.id_horario = $datos2[id_horario] AND distribucion.dia = '$dias[$i]' ORDER BY horario.id_horario";

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