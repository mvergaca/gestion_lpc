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
    <title>Inicio Administrador</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">

    <script src="css/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <script type="text/javascript">
        $(document).ready(function () {
            $("#buscar").click(function () {
                var curso = $("#curso").val();
                var asigna = $("#asignatura").val();


                if(asigna != "" || curso != ""){
                    $.ajax({
                        type: "POST",
                        url: "cargar_asistencia.php",
                        data: {"curso":curso,
                            "asigna":asigna
                        },
                        success: function (data) {
                            datos = data.split("|");
                            if(datos[1] == 1){
                                $("#asistencia").html(datos[2]);
                            }
                            else{
                                alert(datos[2]);
                            }
                        }
                    });
                }
                else{
                    alert("Seleccione una asignatura");
                }
            });
        });

        function cargar_asignaturas() {
            var curso = $("#curso").val();

            $.ajax({
                type: "POST",
                url: "cargar_asignatura.php",
                data: {"curso":curso
                },
                success: function (data) {
                    datos = data.split(";");
                    if(datos[1] == 1){
                        $("#asignatura").html(datos[2]);
                    }
                    else{
                        alert("El curso seleccionado no tiene asignaturas");
                    }
                }
            });
        }
    </script>

</head>
<body>

<section id="encabezado">
    <?php
    include "head_administrador.php";
    ?>
</section>

<section id="principal">
    <div class="col-sm-offset-0 col-sm-12">
        <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5;'>
            <h4>Buscar asistencia</h4>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <div class="col-sm-offset-4 col-sm-2">
                    <label>Curso</label>
                </div>
                <div class="col-sm-3">
                    <select id="curso" class="form-control" onchange="cargar_asignaturas()">
                        <option value=""> - - - </option>
                        <?php
                        $sql = "SELECT * FROM curso";
                        $res = $dbcon->query($sql);

                        while($datos = mysqli_fetch_array($res)){
                            echo"<option value='$datos[id_curso]'>$datos[nombre_curso]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-bottom: 2%">
                <div class="col-sm-offset-4 col-sm-2">
                    <label>Asignatura</label>
                </div>
                <div class="col-sm-3">
                    <select id="asignatura" class="form-control">
                        <option value=""> - - - </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <input type="button" class="btn btn-info" value="Buscar" id="buscar" style="margin-bottom: 2%">
            </div>
            <div class="col-sm-offset-0 col-sm-12">
                <div class="col-sm-offset-1 col-sm-10" id="asistencia">

                </div>
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