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

    <script src="js/editar_reserva.js"></script>
</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal" style="min-height: 540px;">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">

            <h3>Editar Reserva de Sala</h3>

            <div id="form" class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="sala" class="col-sm-offset-3 col-sm-2">Sala</label>
                <div class="col-sm-4">
                    <select id="sala" class="form-control">
                        <?php
                        $sql4 = "SELECT * FROM reserva 
                                INNER JOIN sala ON sala.id_sala = reserva.id_sala
                                WHERE id_reserva = $_GET[id]";
                        $res4 = $dbcon->query($sql4);
                        while ($dat4=mysqli_fetch_array($res4)){
                            echo"<option value='$dat4[id_sala]'>$dat4[nombre_sala]</option>";
                        }
                        $res4->close();

                        $sql3="SELECT * FROM sala
                              ORDER BY nombre_sala";
                        $res3 = $dbcon->query($sql3);
                        while ($datos3 = mysqli_fetch_array($res3)){
                            echo"<option style='font-size: 12px' value='$datos3[id_sala]'>$datos3[nombre_sala]</option>";
                        }
                        $res->close();
                        ?>
                    </select>
                </div>
            </div>

            <div id="form" class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="prof" class="col-sm-offset-3 col-sm-2">Profesor</label>
                <div class="col-sm-4">
                    <select id="prof" class="form-control">
                        <?php


                        $sql5 = "SELECT * FROM reserva 
                                INNER JOIN profesor ON profesor.id_profesor = reserva.id_profesor
                                INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                                WHERE id_reserva = $_GET[id]";
                        $res5 = $dbcon->query($sql5);
                        while ($dat5=mysqli_fetch_array($res5)){
                            echo"<option style='font-size: 12px' value='$dat5[id_profesor]'>$dat5[nombre_usr] $dat5[apellido_p_usr] $dat5[apellido_m_usr]</option>";
                        }
                        $res5->close();
                        $sql="SELECT * FROM profesor 
                                      INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                                      ORDER BY nombre_usr";
                        $res = $dbcon->query($sql);
                        while ($datos = mysqli_fetch_array($res)){
                            echo"<option style='font-size: 12px' value='$datos[id_profesor]'>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</option>";
                        }
                        $res->close();
                        ?>
                    </select>
                </div>
            </div>

            <div id="form" class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="fecha" class="col-sm-offset-3 col-sm-2">Fecha</label>
                <div class="col-sm-4">
                    <?php
                    $sql6 = "SELECT * FROM reserva 
                                WHERE id_reserva = $_GET[id]";
                    $res6 = $dbcon->query($sql6);
                    while ($dat6=mysqli_fetch_array($res6)){
                        $fecha = $dat6["fecha_reserva"];
                    }
                    $res6->close();
                    ?>
                    <input type="date" id="fecha" class="form-control" value="<?php echo"$fecha";?>">
                </div>
            </div>

            <div id="form" class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="bloque" class="col-sm-offset-3 col-sm-2">Bloque</label>
                <div class="col-sm-4">
                    <select id="bloque" class="form-control">
                        <?php
                        $sql7 = "SELECT * FROM reserva 
                                  INNER JOIN horario ON horario.hora_inicio = reserva.inicio_reserva
                                    WHERE id_reserva = $_GET[id]";
                        $res7 = $dbcon->query($sql7);
                        while ($dat7=mysqli_fetch_array($res7)){
                            echo"<option value='$dat7[id_horario]'>$dat7[hora_inicio] - $dat7[hora_fin]</option>";
                        }
                        $res7->close();

                        $sql2 = "SELECT * FROM horario";
                        $res2 = $dbcon->query($sql2);
                        while($datos2 = mysqli_fetch_array($res2)){
                            echo"<option value='$datos2[id_horario]'>$datos2[hora_inicio] - $datos2[hora_fin]</option>";
                        }
                        $res2->close();
                        ?>
                    </select>
                </div>
            </div>



            <div id="form" class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
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