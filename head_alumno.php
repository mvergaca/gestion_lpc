

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
                        $sql = "select * from curso";
                        $res = $dbcon -> query($sql);

                        while($dato = mysqli_fetch_array($res)){
                            echo "
                        <li class=\"dropdown-submenu\"><a>$dato[nombre_curso]</a>
                            <ul class=\"dropdown-menu\">
                                <li><a href=\"ver_clase.php?curso=$dato[id_curso]\">Asignatura 1</a></li>
                                <li><a href=\"ver_clase.php?curso=$dato[id_curso]\">Asignatura 2</a></li>
                                <li><a href=\"ver_clase.php?curso=$dato[id_curso]\">Asignatura 3</a></li>
                            </ul>
                        </li>
                        ";
                        }
                        $res->close();
                        ?>

                        <!--<li class="dropdown-submenu"><a>Cuarto A</a>
                            <ul class="dropdown-menu">
                                <li><a href="ver_clase.php">Asignatura 1</a></li>
                                <li><a href="ver_clase.php">Asignatura 2</a></li>
                                <li><a href="ver_clase.php">Asignatura 3</a></li>
                            </ul>
                        </li>-->
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Notas</b>
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <?php
                        $sql2 = "select * from curso";
                        $res2 = $dbcon -> query($sql2);
                        while ($dato2 = mysqli_fetch_array($res2)){
                            echo"
                        <li class=\"dropdown-submenu\"><a>$dato2[nombre_curso]</a>
                            <ul class=\"dropdown-menu\">
                            
                                <li class=\"dropdown-submenu\"><a>Asignatura 1</a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a  href=\"tomar_asistencia.php?curso=$dato2[id_curso]\">Tomar asistencia</a></li>
                                        <li><a href=\"#\">Observacion alumno</a></li>
                                    </ul>
                                </li>
                                
                                <li class=\"dropdown-submenu\"><a>Asignatura 2</a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a  href=\"tomar_asistencia.php?curso=$dato2[id_curso]\">Tomar asistencia</a></li>
                                        <li><a href=\"#\">Observacion alumno</a></li>
                                    </ul >
                                </li >
                                
                                <li class=\"dropdown-submenu\"><a>Asignatura 3</a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a  href=\"tomar_asistencia.php?curso=$dato2[id_curso]\">Tomar asistencia</a></li>
                                        <li><a href=\"#\">Observacion alumno</a></li>
                                    </ul >
                                </li >
                            </ul>
                        </li>
                        ";
                        }
                        $res2->close();
                        ?>

                        <!--<li class="dropdown-submenu">Primero A</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu"><a>Asignatura 1</a>
                                    <ul class="dropdown-menu">
                                        <li href="#"><a>Tomar asistencia</a></li>
                                        <li href="#"><a>Observacion alumno</a></li>
                                    </ul>
                                </li>
                                <li href="#"><a>Asignatura 2</a></li>
                                <li href="#"><a>Asignatura 3</a></li>
                            </ul>
                        </li>-->
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Observaciones</b>
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a>Primero A</a>
                            <ul class="dropdown-menu">
                                <li href="#"><a>Asignatura 1</a></li>
                                <li href="#"><a>Asignatura 2</a></li>
                                <li href="#"><a>Asignatura 3</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a>Segundo A</a>
                            <ul class="dropdown-menu">
                                <li href="#"><a>Asignatura 1</a></li>
                                <li href="#"><a>Asignatura 2</a></li>
                                <li href="#"><a>Asignatura 3</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a>Tercero A</a>
                            <ul class="dropdown-menu">
                                <li href="#"><a>Asignatura 1</a></li>
                                <li href="#"><a>Asignatura 2</a></li>
                                <li href="#"><a>Asignatura 3</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a>Cuarto A</a>
                            <ul class="dropdown-menu">
                                <li href="#"><a>Asignatura 1</a></li>
                                <li href="#"><a>Asignatura 2</a></li>
                                <li href="#"><a>Asignatura 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">

                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

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