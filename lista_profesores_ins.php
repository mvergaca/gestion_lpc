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

    <script>
        function ver_profesor(ref) {
            window.location.href = "ver_profesor_ins.php?id="+ref;
        }
    </script>

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
            <h3>Lista de Profesores</h3>
            <div class="col-sm-offset-1 col-sm-10">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <td class="col-sm-7"><label>Nombre</label></td>
                        <td class="col-sm-3"><label>Encargado</label></td>
                        <td class="col-sm-2"><label>Ver Horario</label></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM profesor
                            LEFT JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                            ORDER BY usuario.nombre_usr";

                    $res = $dbcon -> query($sql);

                    while($datos = mysqli_fetch_array($res)){
                        echo"
                        <tr>
                            <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                            <td>";
                        $sql2 = "SELECT * FROM curso
                                        WHERE curso.id_profesor = $datos[id_profesor]";

                        $res2 = $dbcon -> query($sql2);

                        while ($datos2 = mysqli_fetch_array($res2)){
                            echo"$datos2[nombre_curso]";
                        }
                        $res2->close();
                        echo"</td>
                            <td><input type='button' class='btn btn-success' value='Ver' onclick='ver_profesor($datos[id_profesor])'></td>
                        </tr>
                        ";
                    }
                    $res->close();
                    ?>
                    </tbody>
                </table>
            </div>
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