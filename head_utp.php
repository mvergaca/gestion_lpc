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
                <li><a href="inicio_utp.php" style="color: #0f0f0f"><b>Inicio</b></a></li>
                <li><a href="buscar_usuario_utp.php" style="color: #0f0f0f"><b>Buscar</b></a></li>
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
                            <li><a href='ver_curso.php?curso=$dato[id_curso]'>$dato[nombre_curso]</a></li>
                            ";
                        }
                        $res->close();
                        ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Notas</b>
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <?php
                        $sql2 = "SELECT * FROM curso ORDER BY id_curso";
                        $res2 = $dbcon -> query($sql2);
                        while ($dato2 = mysqli_fetch_array($res2)){
                            echo"
                        <li class=\"dropdown-submenu\"><a>$dato2[nombre_curso]</a>
                            <ul class=\"dropdown-menu\">";

                            $sql_as2 = "SELECT * FROM asignatura
                                INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                                INNER JOIN curso ON curso.id_curso = clase.id_curso                          
                                WHERE curso.id_curso = $dato2[id_curso]";
                            $res_as2 = $dbcon -> query($sql_as2);
                            while ($dato_as2 = mysqli_fetch_array($res_as2)) {
                                echo "
                                <li class=\"dropdown-submenu\"><a>$dato_as2[nombre_asignatura]</a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a href=\"ver_notas_asig.php?curso=$dato2[id_curso]&asig=$dato_as2[id_asignatura]\">Ver Notas</a></li>
                                    </ul>
                                </li>";
                            }
                            echo"       
                            </ul>
                        </li>
                        ";
                        }
                        $res2->close();
                        ?>
                    </ul>
                </li>

                <li><a href="lista_profesores.php" style="color: #0f0f0f"><b>Profesores</b></a></li>


            </ul>

            <ul class="nav navbar-nav navbar-right">

                <!--<form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Buscar">
                    </div>
                    <button type="submit" class="btn btn-default">Buscar</button>
                </form>-->

                <a class="navbar-brand" style="color: #0f0f0f" href="#"><?php echo$_SESSION['nombre']." ".$_SESSION['apellido_p']." ".$_SESSION['apellido_m'];?></a>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class=" navbar-btn glyphicon glyphicon-align-justify"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="ver_perfil_utp.php">Ver Perfil</a></li>
                        <li><a href="modificar_pass_utp.php">Cambiar Contraseña</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
                    </ul>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>