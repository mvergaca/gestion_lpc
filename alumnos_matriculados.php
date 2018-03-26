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

    <script>
        $(document).ready(function () {
            $("#buscar").click(function () {
                var anio = $("#anio").val();
                if(anio == ""){
                    alert("Ingrese año");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "cargar_matriculados.php",
                        data: {"anio":anio
                        },
                        success: function (data) {
                            datos = data.split("|");
                            if(datos[1] == 1){
                                $("#lista").html(datos[2]);
                            }
                            else{
                                alert("No hay alumnos matriculados en el año seleccionado");
                            }
                        }
                    });
                }
            });
        });
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
    <div class="col-sm-offset-2 col-sm-8" style="background-color: #f7ecb5">
        <h3>Alumnos matriculados</h3>
        <div class="col-sm-offset-0 col-sm-12">
            <div class="col-sm-offset-4 col-sm-1" style="margin-top: 2%">
                <label>Año</label>
            </div>
            <div class="col-sm-3" style="margin-top: 2%">
                <input type="text" class="form-control" id="anio">
            </div>
        </div>
        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <input type="button" class="btn btn-success" value="buscar" id="buscar" style="margin-bottom: 2%">
        </div>
        <div id="lista">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td class="col-sm-1"><label>N°</label></td>
                    <td class="col-sm-3"><label>Curso</label></td>
                    <td class="col-sm-6"><label>Nombre</label></td>
                    <td class="col-sm-2"><label>Año</label></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $num = 1;
                $sql = "SELECT * FROM alumno 
                            INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                            INNER JOIN lista ON lista.id_alumno = alumno.id_alumno
                            INNER JOIN curso ON curso.id_curso = lista.id_curso
                            LEFT JOIN retirado ON retirado.rut_usr = alumno.rut_usr
                            WHERE lista.anio = YEAR(NOW()) AND retirado.rut_usr IS NULL";
                $res = $dbcon->query($sql);

                while($datos = mysqli_fetch_array($res)){
                    echo"
                        <tr>
                            <td>$num</td>
                            <td>$datos[nombre_curso]</td>
                            <td>$datos[nombre_usr] $datos[apellido_m_usr] $datos[apellido_m_usr]</td>
                            <td>$datos[anio]</td>
                        </tr>
                        ";
                    $num = $num + 1;
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