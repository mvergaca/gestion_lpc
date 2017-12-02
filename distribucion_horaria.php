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

<script src="js/distribucion_horaria.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <?php
            $sql = "SELECT * FROM curso WHERE id_curso = $_GET[id]";
            $res = $dbcon->query($sql);
            while ($datos = mysqli_fetch_array($res)){
                echo"<h3><label>$datos[nombre_curso]</label></h3>";
            }



        ?>
        <form class="form-inline col-sm-offset-3 col-sm-6" style='background-color: #f7ecb5;'>
            <input type="hidden" id="curso" value="<?php echo"$_GET[id]";?>">

            <div class=" form-group row col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <div class="col-sm-offset-0 col-sm-4">
                <label for="clase">Asignatura</label>
                </div>
                <div class="col-sm-6">
                <select id="clase" class="form-control">
                    <option value=""> - - - </option>
                    <?php
                    $anio = date("Y");
                    $sql2 = "SELECT * FROM curso 
                            INNER JOIN clase ON clase.id_curso = curso.id_curso
                            INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                            INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                            INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                            WHERE curso.id_curso = $_GET[id] AND clase.anio = $anio";
                    $res2 = $dbcon->query($sql2);
                    while ($datos2 = mysqli_fetch_array($res2)){
                        echo"<option value='$datos2[id_clase]' style='font-size: 12px'>$datos2[nombre_asignatura] - $datos2[nombre_usr] $datos2[apellido_p_usr]</option>";
                    }
                    ?>
                </select>
                </div>
            </div>


            <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <label for="horario" class="col-sm-offset-0 col-sm-4">Horario</label>
                    <select id="horario" class="form-control" style="font-size: 12px">
                        <option value="" > - - - </option>
                        <?php
                        $sql4 = "SELECT * FROM horario";
                        $res4 = $dbcon->query($sql4);
                        while ($datos4 = mysqli_fetch_array($res4)){
                            echo"<option value='$datos4[id_horario]' >$datos4[hora_inicio] - $datos4[hora_fin]</option>";
                        }
                        ?>
                    </select>
            </div>

            <div class=" form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <label for="dia" class="col-sm-offset-0 col-sm-4">Dia</label>
                <select id="dia" class="form-control" style="font-size: 12px">
                    <option value="" > - - - </option>
                    <option value="lunes">Lunes</option>
                    <option value="martes">Martes</option>
                    <option value="miercoles">Miercoles</option>
                    <option value="jueves">Jueves</option>
                    <option value="viernes">Viernes</option>
                </select>
            </div>


            <div class="form-group col-sm-offset-0 col-sm-12" style="margin: 2%">
                <input type="button" id="guardar" class="btn btn-success" value="Guardar">
            </div>
        </form>


        <div id="alerta" class="form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%"></div>

        <div id="mostrar" class="form-group col-sm-offset-0 col-sm-12" style="margin-top: 2%">

            <table id="tabla-horario" class="table-responsive table-bordered col-sm-offset-2 col-sm-8">
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
                     LEFT JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                     LEFT JOIN curso ON clase.id_curso = curso.id_curso
                     LEFT JOIN asignatura ON clase.id_asignatura = asignatura.id_asignatura
                     WHERE curso.id_curso = $_GET[id] AND horario.id_horario = $datos2[id_horario] AND distribucion.dia = '$dias[$i]' ORDER BY horario.id_horario";
                        $res = $dbcon->query($sql) or die("no se pudo mostrar horario" . mysqli_error());

                        if(mysqli_num_rows($res) > 0){
                            while ($datos = mysqli_fetch_array($res)) {
                                if($datos["dia"] == "lunes"){
                                    $dia = 1;
                                }
                                if($datos["dia"] == "martes"){
                                    $dia = 2;
                                }
                                if($datos["dia"] == "miercoles"){
                                    $dia = 3;
                                }
                                if($datos["dia"] == "jueves"){
                                    $dia = 4;
                                }
                                if($datos["dia"] == "viernes"){
                                    $dia = 5;
                                }
                                echo "<td><span class='glyphicon glyphicon-remove-sign col-sm-offset-9 col-sm-3 col-xs-offset-9 col-xs-3' onclick='eliminar_dist($datos[id_curso],$datos[id_horario],$dia,$datos[id_clase]);'></span>$datos[nombre_asignatura] - $datos[nombre_usr] $datos[apellido_p_usr]</td>";
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
            </table>
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