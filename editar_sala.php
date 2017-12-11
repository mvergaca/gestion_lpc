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

    <script src="js/editar_sala.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal" style="min-height: 540px;">
    <div class="col-sm-offset-0 col-sm-12">
        <h3>Editar asignatura</h3>

        <?php
        $sql = "SELECT * FROM sala 
                INNER JOIN usuario ON usuario.rut_usr = sala.encargado
                WHERE id_sala = $_GET[id]";
        $res = $dbcon->query($sql);

        while($dat=mysqli_fetch_array($res)){
            $nombre = $dat['nombre_sala'];
            $encargado = $dat["nombre_usr"]." ".$dat["apellido_p_usr"]." ".$dat["apellido_m_usr"];
            $usr = $dat["encargado"];
        }
        $res->close();

        echo"<input type='hidden' id='id_as' value='$_GET[id]'>";
        ?>
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">
            <div id="form" class="form-group col-sm-offset-0 col-sm-12">

                <div class="form-group col-sm-offset-0 col-sm-12">
                    <label for="asig" class="control-label col-sm-offset-3 col-sm-2">Nombre Sala</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="nombre" value="<?php echo"$nombre";?>">
                    </div>
                </div>

                <div class="form-group col-sm-offset-0 col-sm-12">
                    <label for="encargado" class="control-label col-sm-offset-3 col-sm-2">Encargado</label>
                    <div class="col-sm-4">
                        <select id="encargado" class="form-control">
                            <option value="<?php echo"$usr";?>"><?php echo"$encargado";?></option>
                            <?php
                            $sql = "SELECT * FROM usuario
                                    INNER JOIN profesor ON profesor.rut_usr = usuario.rut_usr
                                    ORDER BY usuario.nombre_usr";
                            $res = $dbcon->query($sql);
                            while($datos = mysqli_fetch_array($res)){
                                echo"<option value='$datos[rut_usr]' style='font-size: 12px'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</option>";
                            }
                            $sql2 = "SELECT * FROM usuario
                                    INNER JOIN administrador ON administrador.rut_usr = usuario.rut_usr
                                    ORDER BY usuario.nombre_usr";
                            $res2 = $dbcon->query($sql2);
                            while($datos2 = mysqli_fetch_array($res2)){
                                echo"<option value='$datos2[rut_usr]' style='font-size: 12px'>$datos2[nombre_usr] $datos2[apellido_p_usr] $datos2[apellido_m_usr]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                    <div class="col-sm-offset-0 col-sm-12">
                        <input type="button" class="btn btn-success" id="guardar" value="Guardar" style="margin: 5px">
                    </div>

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