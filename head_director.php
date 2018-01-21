<nav class="navbar navbar-default" style="background-color: #34a9b6;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">

            <ul class="nav navbar-nav navbar-left navbar-header" style="margin-left: 3%">
                <li><a href="inicio_director.php" style="color: #0f0f0f"><b>Inicio</b></a></li>
                <li><a href="buscar_usuario_sec.php" style="color: #0f0f0f"><b>Buscar</b></a></li>
                <li class="dropdown" >
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Cursos</b>
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <?php
                        $sql = "SELECT * FROM curso ORDER BY id_curso";
                        $res = $dbcon -> query($sql);

                        while($dato = mysqli_fetch_array($res)){
                            echo "
                            <li><a href='ver_curso_dir.php?curso=$dato[id_curso]'>$dato[nombre_curso]</a></li>
                            ";
                        }
                        $res->close();
                        ?>
                    </ul>
                </li>


                <li><a href="lista_profesores_dir.php" style="color: #0f0f0f"><b>Profesores</b></a></li>


            </ul>

            <ul class="nav navbar-nav navbar-right">

                <a class="navbar-brand" style="color: #0f0f0f" href="#"><?php echo$_SESSION['nombre']." ".$_SESSION['apellido_p']." ".$_SESSION['apellido_m'];?></a>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class=" navbar-btn glyphicon glyphicon-align-justify"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="ver_perfil_secretaria.php">Ver Perfil</a></li>
                        <li><a href="modificar_pass_secretaria.php">Cambiar Contraseña</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
                    </ul>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>