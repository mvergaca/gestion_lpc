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

    <script src="js/ver_clase.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_profesor.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
    <?php
    $sql2 = "SELECT * FROM curso
             INNER JOIN clase ON clase.id_curso = curso.id_curso
             INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
             WHERE asignatura.id_asignatura = $_GET[asigna] AND curso.id_curso = $_GET[curso]";
    $res2 = $dbcon ->query($sql2);
    while ($datos2 = mysqli_fetch_array($res2)) {
        $curso = $datos2['nombre_curso'];
        $asig = $datos2['nombre_asignatura'];
    }
    $res2 ->close();
    ?>
        <div class="col-sm-offset-2 col-sm-8 col-xs-offset-0 col-xs-12" style="background-color: #f7ecb5;">
            <h4>Mensajes <?php echo"$asig $curso"; ?> </h4>
        <table class=" table table-bordered table-responsive" id="tabla_mensajes">
            <thead>
            <tr>
                <td class="col-sm-8"><label>Mensaje</label></td>
                <td class="col-sm-2"><label>Fecha</label></td>
                <td class="col-sm-1"><label>Modificar</label></td>
                <td class="col-sm-1"><label>Eliminar</label></td>
            </tr>
            </thead>

        <?php
        $sql = "SELECT * FROM mensaje 
                INNER JOIN profesor ON profesor.id_profesor = mensaje.id_profesor
                INNER JOIN asignatura ON asignatura.id_asignatura = mensaje.id_asignatura
                INNER JOIN curso ON curso.id_curso = mensaje.id_curso
                WHERE profesor.rut_usr = '$_SESSION[rut_usr]' AND mensaje.fecha_mensaje >= CURDATE()
                ORDER BY mensaje.fecha_mensaje";
        $res = $dbcon -> query($sql);
        $i = 1;
        while ($datos = mysqli_fetch_array($res)){
            echo"<tr id='fila_$i'>
                    <input type='hidden' name='mensaje' id='mensaje_$i' value='$datos[id_mensaje]'>
                    <td><textarea id='texto_$i' name='texto' class='form-control'>$datos[mensaje]</textarea></td>
                    <td>$datos[fecha_mensaje]</td>
                    <td align='center'><input type='button' id='modificar_$i' class='btn btn-info' value='Modificar' onclick='modificar($i);'>
                    <input type='button' id='guardar_$i' name='guardar' value='Guardar' class='btn btn-success' onclick='guardar($i);'></td>
                    <td align='center'><input type='button' id='eliminar_$i' class='btn btn-danger' value='Eliminar' onclick='eliminar($i);'></td>
                 </tr>";
            $i++;
        }
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