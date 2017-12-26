

<nav class="navbar navbar-default" style="background-color: #34a9b6;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <img src="imagenes/logo_min.png">
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
                <li><a href="inicio_alumno.php" style="color: #0f0f0f"><b>Inicio</b></a></li>
                <li class="dropdown" >
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Asignaturas</b>
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <?php
                        $sql = "SELECT * FROM asignatura 
                                INNER JOIN clase ON asignatura.id_asignatura = clase.id_asignatura
                                INNER JOIN curso ON curso.id_curso = clase.id_curso
                                INNER JOIN lista ON lista.id_curso = curso.id_curso
                                INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                                WHERE usuario.rut_usr = '$_SESSION[rut_usr]'
                                ORDER BY asignatura.nombre_asignatura";
                        $res = $dbcon -> query($sql);

                        while($dato = mysqli_fetch_array($res)){
                            echo "
                        <li class=\"dropdown-submenu\"><a>$dato[nombre_asignatura]</a>
                            <ul class=\"dropdown-menu\">
                                <li><a href=\"ver_notas.php?id=$dato[id_alumno]\">Notas</a></li>
                                <li><a href=\"#\">Material Estudiantil</a></li>
                                <li><a href=\"mensaje_clase.php?asig=$dato[id_asignatura]\">Mensajes</a></li>
                            </ul>
                        </li>
                        ";
                        }
                        $res->close();
                        ?>
                    </ul>
                </li>

                <li><a href="observaciones_alumno.php" style="color: #0f0f0f"><b>Anotaciones</b></a></li>



            </ul>

            <ul class="nav navbar-nav navbar-right">

                <a class="navbar-brand" style="color: #0f0f0f" href="#"><?php echo$_SESSION['nombre']." ".$_SESSION['apellido_p']." ".$_SESSION['apellido_m'];?></a>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class=" navbar-btn glyphicon glyphicon-align-justify"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Editar Perfil</a></li>
                        <li><a href="#">Cambiar Contraseña</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
                    </ul>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>