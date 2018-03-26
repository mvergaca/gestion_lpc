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

            <ul class="nav navbar-nav navbar-left">
                <li><a href="inicio_administrador.php" style="color: #0f0f0f"><b>Inicio</b></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Usuarios</b><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="usuario_buscar.php">Buscar Usuario</a></li>
                        <li><a href="usuario_crear.php">Crear Usuario</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-submenu"><a>Alumnos</a>
                            <ul class="dropdown-menu">
                                <li><a href="alumnos_egresados.php">Alumnos egresados</a></li>
                                <li><a href="alumnos_matriculados.php">Alumnos matriculados</a></li>
                                <li><a href="alumnos_retirados.php">Alumnos retirados</a></li>
                            </ul>
                        </li>
                        <li><a href="asignar_apoderados.php">Apoderados</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Cursos</b><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="curso_crear.php">Crear Curso</a></li>
                        <li><a href="cursos_ver.php">Ver Cursos</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="crear_lista.php">Crear Listas</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Establecimiento</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Asignaturas</b><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="asignatura_crear.php">Crear Asignatura</a></li>
                        <li class="dropdown-submenu"><a>Asignar Asignatura</a>
                            <ul class="dropdown-menu">
                                <?php
                                $sql2 = "SELECT * FROM curso";
                                $res2 = $dbcon->query($sql2);
                                while ($datos2 = mysqli_fetch_array($res2)){
                                    echo"<li><a href='asignatura_asignar.php?curso=$datos2[id_curso]'>$datos2[nombre_curso]</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-submenu"><a>Distribucion Horaria</a>
                            <ul class="dropdown-menu">
                                <?php
                                $sql = "SELECT * FROM curso";
                                $res = $dbcon->query($sql);
                                while ($datos = mysqli_fetch_array($res)){
                                    echo"<li><a href='distribucion_horaria.php?id=$datos[id_curso]'>$datos[nombre_curso]</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="ingresar_nota_adm.php">Ingresar Notas</a></li>
                        <li><a href="semestre.php">Semestres</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Salas</b><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="sala_crear.php">Crear Sala</a></li>
                        <li class="dropdown-submenu"><a>Reservar Sala</a>
                            <ul class="dropdown-menu">
                                <?php
                                $sql3 = "SELECT * FROM sala ORDER BY nombre_sala";
                                $res3 = $dbcon->query($sql3);
                                while ($datos3 = mysqli_fetch_array($res3)){
                                    echo"<li><a href='reservar_sala.php?id=$datos3[id_sala]'>$datos3[nombre_sala]</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                        <li><a href="ver_reservas.php">Ver Reservas</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">


                <a class="navbar-brand" style="color: #0f0f0f" href="#"><?php echo$_SESSION['nombre']." ".$_SESSION['apellido_p']." ".$_SESSION['apellido_m'];?></a>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class=" navbar-btn glyphicon glyphicon-align-justify"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="ver_perfil_administrador.php">Ver Perfil</a></li>
                        <li><a href="modificar_pass_adm.php">Cambiar Contraseña</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
                    </ul>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>