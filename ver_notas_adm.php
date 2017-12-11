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
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <?php
            $sql = "SELECT * FROM asignatura WHERE id_asignatura = $_GET[asig]";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                $asignatura = $datos["nombre_asignatura"];
            }

            $sql2 = "SELECT * FROM curso WHERE id_curso = $_GET[curso]";
            $res2 = $dbcon->query($sql2);
            while ($datos2 = mysqli_fetch_array($res2)){
                $curso = $datos2["nombre_curso"];
            }

            $sql3 = "SELECT * FROM semestre WHERE inicio_semestre <= CURRENT_DATE () AND fin_semestre >= CURRENT_DATE ()";
            $res3 = $dbcon->query($sql3);
            while ($datos3 = mysqli_fetch_array($res3)){
                $semestre = $datos3["nombre_sem"];
                $id_semestre = $datos3["id_semestre"];
            }
            echo"<h3>$asignatura - $curso - $semestre</h3>";

            $sql4 = "SELECT * FROM alumno
                      INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                      INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                      INNER JOIN curso ON curso.id_curso = lista.id_curso
                      WHERE curso.id_curso = $_GET[curso]";
            $res4 = $dbcon->query($sql4);

            echo"<table class='table table-bordered table-responsive'>
                    <thead>
                    <tr>
                        <td class='col-sm-5'><label>Nombre</label></td>
                        <td class='col-sm-6'><label>Notas</label></td>
                        <td class='col-sm-1'><label>Promedio</label></td>
                    </tr>
                    </thead>
                    <tbody>";

            while ($datos4 = mysqli_fetch_array($res4)){
                echo"<tr>
                    <td>$datos4[nombre_usr] $datos4[apellido_p_usr] $datos4[apellido_m_usr]</td>
                    <td>
                    <table class='table table-bordered table-responsive'>
                    <tr>";

                $sql5 = "SELECT * FROM nota WHERE id_alumno = $datos4[id_alumno] AND id_asignatura = $_GET[asig] 
                          AND id_semestre = $id_semestre";
                $res5 = $dbcon->query($sql5);

                $notas = array(null,null,null,null,null,null,null,null,null,null);
                $i = 0;

                while($datos5 = mysqli_fetch_array($res5)){
                    $notas[$i] = $datos5['nota'];
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

                    echo"</tr>
                    </table>
                    </td>
                    <td><table class='table table-bordered'><tr><td>$prom</td></tr></table></td>
                </tr>";

            }

        echo"</tbody></table";
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