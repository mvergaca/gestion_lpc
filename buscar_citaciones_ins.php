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

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <script>
        $(document).ready(function () {
            $("#buscar").click(function () {
                var desde = $("#desde").val();
                var hasta = $("#hasta").val();

                var date = new Date();

                var anio_actual = date.getFullYear();
                var mes_actual = date.getMonth()+1;
                var dia_actual = date.getDate();

                if(mes_actual < 10){
                    mes_actual = "0"+mes_actual;
                }
                if(dia_actual < 10){
                    dia_actual = "0"+dia_actual;
                }

                var actual = anio_actual+"-"+mes_actual+"-"+dia_actual;

                if(desde != "" && hasta != ""){
                    if(desde < actual && hasta <= actual && desde < hasta) {
                        $.ajax({
                            type: "POST",
                            url: "cargar_citaciones.php",
                            data: {
                                "desde":desde,
                                "hasta":hasta
                            },
                            success: function (data) {
                                datos = data.split("|");
                                if (datos[1] == 1) {
                                    $("#tabla").html(datos[2]);
                                }
                                else {
                                    alert("No se han encontrado resultados");
                                }
                            }
                        });
                    }
                    else{
                        alert("La fecha debe ser menor a la de hoy");
                    }
                }
                else{
                    alert("Todos los campos son necesarios");
                }
            });
        });
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
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>

            <h3>Buscar citaciones</h3>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <div class="col-sm-offset-4 col-sm-1">
                    <label>Desde</label>
                </div>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="desde">
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <div class="col-sm-offset-4 col-sm-1">
                    <label>Hasta</label>
                </div>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="hasta">
                </div>
            </div>

            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 1%">
                <input type="button" class="btn btn-success" value="Buscar" id="buscar">
            </div>

            <div class="col-sm-offset-0 col-sm-12" id="tabla">
                <table class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <td class="col-sm-4"><label>Alumno</label></td>
                        <td class="col-sm-2"><label>Fecha</label></td>
                        <td class="col-sm-2"><label>Hora</label></td>
                        <td class="col-sm-4"><label>Motivo</label></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM citacion
                            inner join alumno on alumno.id_alumno = citacion.id_alumno
                            inner join usuario on usuario.rut_usr = alumno.rut_usr
                            where citacion.fecha = current_date()";
                    $res = $dbcon->query($sql);
                    while($datos = mysqli_fetch_array($res)){
                        echo"
                        <tr>
                            <td>$datos[nombre_usr] $datos[apellido_p_usr] $datos[apellido_m_usr]</td>
                            <td>$datos[fecha]</td>
                            <td>$datos[hora]</td>
                            <td>$datos[motivo]</td>    
                        </tr>
                        ";
                    }
                    ?>
                    </tbody>
                </table>
            </div>

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