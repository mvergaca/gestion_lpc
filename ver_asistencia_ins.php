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

    <script type="text/javascript">
                $(document).ready(function () {
            $("#buscar").click(function () {
                var curso = $("#curso").val();
                var asigna = $("#asignatura").val();


                if(asigna != ""){
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
            <?php
            $sql = "SELECT * FROM curso WHERE id_curso = $_GET[curso]";
            $res = $dbcon->query($sql);
            while($datos = mysqli_fetch_array($res)){
                echo"<h4>$datos[nombre_curso]</h4>
                    <input type='hidden' id='curso' value='$_GET[curso]'>";
            }
            ?>
            <div class="col-sm-offset-0 col-sm-12">
                <div class="col-sm-offset-4 col-sm-2">
                    <label>Asignatura</label>
                </div>
                <div class="col-sm-3">
                    <select id="asignatura" class="form-control">
                        <option value=""> - - - </option>
                        <?php
                        $sql2 = "SELECT DISTINCT asignatura.id_asignatura, asignatura.nombre_asignatura FROM asignatura
                                INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                                WHERE clase.id_curso = $_GET[curso] ORDER BY asignatura.nombre_asignatura";
                        $res2 = $dbcon->query($sql2);
                        while($datos2 = mysqli_fetch_array($res2)){
                            echo"<option value='$datos2[id_asignatura]'>$datos2[nombre_asignatura]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
                <input type="button" class="btn btn-info" value="Buscar" id="buscar" style="margin-bottom: 2%">
            </div>
            <div class="col-sm-offset-0 col-sm-12">
            <div class="col-sm-offset-1 col-sm-10" id="asistencia">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <td class="col-sm-10">Alumno</td>
                        <td class="col-sm-2">Estado</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql3 = "SELECT * FROM lista
                                INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                                WHERE lista.anio = YEAR(NOW()) AND lista.id_curso = $_GET[curso]
                                ORDER BY usuario.nombre_usr";
                        $res3 = $dbcon->query($sql3);
                        while($datos3 = mysqli_fetch_array($res3)){
                            echo"
                            <tr>
                            <td>$datos3[nombre_usr] $datos3[apellido_p_usr] $datos3[apellido_m_usr]</td>
                            <td><span class=\"glyphicon glyphicon-minus\" aria-hidden=\"true\"></span></td>
                            </tr>
                            ";
                        }
                    ?>
                    </tbody>
                </table>
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