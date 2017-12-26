<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion LPC</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.7/css/bootstrap.css">
</head>

<body background="imagenes/LPC.PNG" style="background-size: cover" class="img-responsive ">

<section id="principal">
<div class="col-sm-offset-0 col-sm-12">

    <div align="center" style="margin-top: 5%">
        <img src="imagenes/LOGO%20LPC.png">
    </div>
<div class="col-sm-offset-4 col-sm-4" style="border: #cb9234 2px solid">
    <form class="form-horizontal col-sm-offset-0 col-sm-12" name="login" action="procesar_login.php" method="post" style="margin-top: 1%">
        <div class="form-group col-sm-offset-0 col-sm-12">
            <label for="inputUsuario3" class="col-sm-offset-1 col-sm-3  control-label">Rut</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputUsuario3" placeholder="11111111-1" name="user">
            </div>
        </div>
        <div class="form-group col-sm-offset-0 col-sm-12">
            <label for="inputPassword3" class="col-sm-offset-1 col-sm-3  control-label">Contraseña</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Ingrese Contraseña" name="pass">
            </div>
        </div>
        <div class="form-group col-sm-offset-0 col-sm-12">
                    <label class="col-sm-offset-3">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </label>

        </div>
        <div class="form-group col-sm-offset-5 col-sm-12">
            <div class="col-sm-offset-4 col-sm-3">
                <button type="submit" class="btn btn-default">Entrar</button>
            </div>
        </div>
    </form>
    <div>
</div>
</section>

<section id="pie">

</section>
</body>
</html>