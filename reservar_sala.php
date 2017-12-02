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

    <script src="js/reservar_sala.js"></script>
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

            <?php $nom = "SELECT * FROM sala WHERE id_sala = $_GET[id]";
                  $re = $dbcon->query($nom);
                while ($dat=mysqli_fetch_array($re)){
                    echo"<h3>Sala $dat[nombre_sala]</h3>
                        <input type='hidden' id='sala' value='$dat[id_sala]'>";
                }
            ?>

            <div id="form" class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                    <label for="prof" class="col-sm-offset-3 col-sm-2">Profesor</label>
                    <div class="col-sm-4">
                        <select id="prof" class="form-control">
                            <option value=""> - - - </option>
                            <?php
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
                <label for="prof" class="col-sm-offset-3 col-sm-2">Fecha</label>
                <div class="col-sm-4">
                    <input type="date" id="fecha" class="form-control">
                </div>
            </div>

            <div id="form" class="form-group col-sm-offset-0 col-sm-12" style="margin: 5px">
                <label for="prof" class="col-sm-offset-3 col-sm-2">Bloque</label>
                <div class="col-sm-4">
                    <select id="bloque" class="form-control">
                        <option value=""> - - - </option>
                        <?php
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


            <div id="lista" class="col-sm-offset-1 col-sm-10">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <td><label>N°</label></td>
                        <td><label>Profesor</label></td>
                        <td><label>Fecha</label></td>
                        <td><label>Horario</label></td>
                        <td><label>Editar</label></td>
                        <td><label>Eliminar</label></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql3 = "SELECT * FROM reserva 
                            INNER JOIN profesor ON profesor.id_profesor = reserva.id_profesor
                            INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                            INNER JOIN sala ON sala.id_sala = reserva.id_sala
                            WHERE (fecha_reserva >= CURRENT_DATE ()) AND sala.id_sala = $_GET[id]
                            ORDER BY fecha_reserva, inicio_reserva";
                    $res3=$dbcon->query($sql3);
                    $i = 1;
                    while ($datos3 = mysqli_fetch_array($res3)){
                        echo"<tr>
                            <td>$i</td>
                            <td>$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</td>
                            <td>$datos3[fecha_reserva]</td>
                            <td>$datos3[inicio_reserva] - $datos3[fin_reserva]</td>
                            <td><input type='button' class='btn btn-info' value='Editar' onclick='editar_reserva($datos3[id_reserva]);'></td>
                            <td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar_reserva($datos3[id_reserva]);'></td>
                         </tr>";
                        $i++;
                    }
                    $res3->close();
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