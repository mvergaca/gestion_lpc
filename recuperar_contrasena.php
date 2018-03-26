<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="content-type" content="text/html">
    <title>Recuperar contraseña</title>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <script type="text/javascript">
        $(document).ready(function () {
            $("#enviar").click(function () {
                var rut = $("#rut").val();
                var correo = $("#correo").val();

                if(rut == "" || correo == ""){
                    alert("Rut y correo son obligatorios");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "recuperar_con.php",
                        data: {"rut":rut,
                               "correo":correo
                        },
                        success: function (data) {
                            datos = data.split(";");
                            if(datos[1] == 1){
                                alert("Solicitud enviada");
                                window.location.href = "index.php"
                            }
                            else{
                                alert("Rut no esta registrado en el sistema");
                            }
                        }
                    })
                }
            })
        });
    </script>

</head>
<body>

<section id="encabezado">
    <div class="col-sm-offset-0 col-sm-12" style="background-color: #34a9b6; height: 50px">

    </div>
</section>

<section id="principal">
<div class="col-sm-offset-0 col-sm-12">
    <div class="col-sm-offset-2 col-sm-8" style='background-color: #f7ecb5; margin-top: 2%'>
        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <div class="col-sm-offset-5 col-sm-1">
                <label>Rut</label>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="rut">
            </div>
        </div>

        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <div class="col-sm-offset-5 col-sm-1">
                <label>Correo</label>
            </div>
            <div class="col-sm-3">
                <input type="email" class="form-control" id="correo">
            </div>
        </div>
        <div class="col-sm-offset-0 col-sm-12" style="margin-top: 2%">
            <input type="button" class="btn btn-success" id="enviar" value="Enviar" style="margin-bottom: 2%">
        </div>

    </div>
</div>
</section>

<section id="pie" class="col-sm-offset-0 col-sm-12">
    <?php
    include "footer.php";
    ?>
</section>
</body>
</html>