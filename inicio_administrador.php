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

<section id="principal">
    <?php
    $sql = "SELECT * FROM asistencia 
                INNER JOIN alumno ON alumno.id_alumno = asistencia.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                WHERE estado = 0 ";
    $res = $dbcon->query($sql);
    if(mysqli_num_rows($res)>0) {
        echo "
    <div id='inasistencias' class='col-sm-offset-0 col-sm-12'>
        <div class='col-sm-offset-2 col-sm-8 alert-danger'>
            <table>
                <thead>
                
                </thead>
                <tbody>";

        while ($datos = mysqli_fetch_array($res)) {
            echo "$datos[id_alumno]<br>";
        }

        echo"   </tbody>
            </table>
        </div>
    </div>";
    }

    $sql2 = "SELECT * FROM reserva WHERE fecha_reserva = CURRENT_DATE ();";
    $res2 = $dbcon->query($sql2);
    if(mysqli_num_rows($res2)>0){
        echo"
        <div id=\"reservas\" class=\"col-sm-offset-2 col-sm-8 alert-info\">
            <table>
                <thead>
                
                </thead>
                <tbody>";



        echo"   </tbody>
            </table>
        </div>
        ";
    }


    $sql3 = "";
    $res3 = $dbcon->query($sql3);
    if(mysqli_num_rows($res3)>0){
        echo"
        <div id=\"casos_sociales\" class=\"col-sm-offset-2 col-sm-8 alert-warning\">
            <table>
                <thead>
                
                </thead>
                <tbody>";



        echo"   </tbody>
            </table>
        </div>
        ";
    }

    ?>


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