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
    <title>Inicio Inspector</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>

    <script src="js/retirar_alumno_ins.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_inspector.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5;">
            <h3>Retiros del dia</h3>
            <table class="table table-responsive table-bordered">
                <thead>
                <tr>
                    <td><label>Alumno</label></td>
                    <td><label>Apoderado</label></td>
                    <td><label>Hora</label></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM autorizacion
                        INNER JOIN alumno ON alumno.id_alumno = autorizacion.id_alumno
                        INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                        WHERE autorizacion.fecha = CURRENT_DATE()";
                $res = $dbcon->query($sql);
                while($datos = mysqli_fetch_array($res)){
                    echo"
                    <tr>
                        <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                        <td>";
                    $sql2 = "SELECT * FROM usuario 
                              INNER JOIN apoderado ON apoderado.rut_usr = usuario.rut_usr
                              WHERE apoderado.id_apoderado = $datos[id_apoderado]";
                    $res2 = $dbcon->query($sql2);

                    while($datos2 = mysqli_fetch_array($res2)){
                        echo"$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]";
                    }

                    echo"</td>
                        <td>$datos[hora]</td>
                    </tr>
                    ";
                }
                $res->close();

                ?>
                </tbody>
            </table>
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