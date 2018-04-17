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

    <script src="js/curso_editar.js"></script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-3 col-sm-6" style='background-color: #f7ecb5;'>
            <input type="hidden" id="curso" value="<?php echo"$_GET[id]";?>">
<?php
$con = "SELECT * FROM curso 
        LEFT JOIN profesor ON profesor.id_profesor = curso.id_profesor
        LEFT JOIN sala ON sala.id_sala = curso.id_sala
        LEFT JOIN establecimiento ON establecimiento.id_establecimiento = curso.id_establecimiento
        LEFT JOIN usuario ON usuario.rut_usr = profesor.rut_usr
        WHERE curso.id_curso = $_GET[id]";
$re_con = $dbcon->query($con);
while ($dat = mysqli_fetch_array($re_con)){
        echo"
            <div class='form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='establecimiento' class='col-sm-offset-2 col-sm-3'>Establecimiento</label>
                <div class='col-sm-5'>
                <select id='establecimiento' class='form-control'>
                    <option value='$dat[id_establecimiento]'>$dat[nombre]</option>";

                    $sql = "SELECT * FROM establecimiento";
                    $res = $dbcon->query($sql);
                    while ($datos = mysqli_fetch_array($res)){
                        echo"<option value='$datos[id_establecimiento]' >$datos[nombre]</option>";
                    }
                echo"    
                </select>
                </div>
            </div>

            <div class='form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='sala' class='col-sm-offset-2 col-sm-3'>Sala</label>
                <div class='col-sm-5'>
                <select id='sala' class='form-control'>
                    <option value='$dat[id_sala]'>$dat[nombre_sala]</option>
                    <option value=''> - - - </option>";
                    $sql2 = "SELECT * FROM sala";
                    $res2 = $dbcon->query($sql2);
                    while ($datos2 = mysqli_fetch_array($res2)){
                        echo"<option value='$datos2[id_sala]'>$datos2[nombre_sala]</option>";
                    }
                    $res2->close();

            echo"
                </select>
                </div>
            </div>

            <div class='form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='profesor' class='col-sm-offset-2 col-sm-3'>Profesor</label>
                <div class='col-sm-5'>
                    <select id='profesor' class='form-control' style='font-size: 12px'>
                        <option value='$dat[id_profesor]' >$dat[nombre_usr] $dat[apellido_p_usr] $dat[apellido_m_usr]</option>";

                        $sql3 = "SELECT * FROM profesor
                             INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr order by usuario.nombre_usr";
                        $res3 = $dbcon->query($sql3);
                        while ($datos3 = mysqli_fetch_array($res3)){
                            echo"<option value='$datos3[id_profesor]' >$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</option>";
                        }
            echo"            
                    </select></div>
            </div>

            <div class='form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <label for='nombre' class='col-sm-offset-2 col-sm-3'>Nombre Curso</label>
                <div class='col-sm-5'>
                <input type='text' id='nombre' class='form-control' value='$dat[nombre_curso]'>
                </div>
            </div>

            <div class='form-group col-sm-offset-0 col-sm-12' style='margin-top: 2%'>
                <input type='button' id='guardar' class='btn btn-success' value='Guardar'>
            </div>            
";
}
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