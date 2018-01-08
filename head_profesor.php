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
                <li><a href="inicio_profesor.php" style="color: #0f0f0f"><b>Inicio</b></a></li>
                <?php
                $con = "SELECT * FROM profesor
                        INNER JOIN curso ON curso.id_profesor = profesor.id_profesor
                        WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
                $res_con = $dbcon -> query($con);
                if(mysqli_num_rows($res_con) > 0){
                    echo"<li><a href=\"mi_curso.php\" style=\"color: #0f0f0f\"><b>Mi Curso</b></a></li>";
                }$res_con->close();
                ?>
                <li class="dropdown" >
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Cursos</b>
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                    <?php
                    $sql = "SELECT DISTINCT curso.nombre_curso, curso.id_curso FROM curso 
                            INNER JOIN clase ON clase.id_curso = curso.id_curso
                            INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                            INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                            WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
                    $res = $dbcon -> query($sql);

                    while($dato = mysqli_fetch_array($res)){
                        echo "
                        <li class=\"dropdown-submenu\"><a>$dato[nombre_curso]</a>
                            <ul class=\"dropdown-menu\">";

                                $sql_as = "select * FROM curso 
                                INNER JOIN clase ON clase.id_curso = curso.id_curso
                                INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                                INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                                WHERE profesor.rut_usr = '$_SESSION[rut_usr]' AND curso.id_curso = $dato[id_curso]";
                                $res_as = $dbcon -> query($sql_as);

                                while ($dato_as = mysqli_fetch_array($res_as)) {
                                    echo "<li class=\"dropdown-submenu\"><a>$dato_as[nombre_asignatura]</a>
                                                <ul class=\"dropdown-menu\">
                                                    <li><a href=\"ver_clase.php?curso=$dato_as[id_curso]&asigna=$dato_as[id_asignatura]\">Ver Clase</a></li>
                                                    <li><a href=\"mensaje_curso.php?curso=$dato_as[id_curso]&asigna=$dato_as[id_asignatura]\">Mensaje al curso</a></li>
                                                    <li><a href=\"material_estudio.php?curso=$dato_as[id_curso]&asigna=$dato_as[id_asignatura]\">Material de estudio</a></li>
                                                </ul>
                                          </li>";
                                }
                           echo" </ul>
                        </li>
                        ";
                    }
                    $res->close();
                    ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Asistencia</b>
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <?php
                        $sql2 = "SELECT DISTINCT curso.nombre_curso, curso.id_curso FROM curso 
                            INNER JOIN clase ON clase.id_curso = curso.id_curso
                            INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                            INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                            WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
                        $res2 = $dbcon -> query($sql2);
                        while ($dato2 = mysqli_fetch_array($res2)){
                        echo"
                        <li class=\"dropdown-submenu\"><a>$dato2[nombre_curso]</a>
                            <ul class=\"dropdown-menu\">";

                            $sql_as2 = "select * from curso 
                                INNER JOIN clase ON clase.id_curso = curso.id_curso
                                INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                                INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                                WHERE profesor.rut_usr = '$_SESSION[rut_usr]' AND curso.id_curso = $dato2[id_curso]";
                                $res_as2 = $dbcon -> query($sql_as2);
                                while ($dato_as2 = mysqli_fetch_array($res_as2)) {
                                    echo "
                                <li class=\"dropdown-submenu\"><a>$dato_as2[nombre_asignatura]</a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a href=\"tomar_asistencia.php?curso=$dato_as2[id_curso]&asig=$dato_as2[id_asignatura]\">Tomar asistencia</a></li>
                                        <li><a href=\"observacion.php?curso=$dato_as2[id_curso]&asig=$dato_as2[id_asignatura]\">Observacion alumno</a></li>
                                        <li><a href=\"ver_asistencia.php?curso=$dato_as2[id_curso]&asi=$dato_as2[id_asignatura]\">Ver Asistencia</a></li>
                                        <li><a href=\"ver_observaciones.php?curso=$dato_as2[id_curso]&asi=$dato_as2[id_asignatura]\">Ver Observaciones</a></li>
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

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color: #0f0f0f" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><b>Notas</b>
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <?php
                        $sql3 = "SELECT DISTINCT curso.nombre_curso, curso.id_curso FROM curso 
                            INNER JOIN clase ON clase.id_curso = curso.id_curso
                            INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                            INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                            WHERE profesor.rut_usr = '$_SESSION[rut_usr]'";
                        $res3 = $dbcon -> query($sql3);
                        while ($dato3 = mysqli_fetch_array($res3)){
                            echo"
                            <li class=\"dropdown-submenu\"><a>$dato3[nombre_curso]</a>
                            <ul class=\"dropdown-menu\">";

                            $sql_as3 = "select * from curso 
                                INNER JOIN clase ON clase.id_curso = curso.id_curso
                                INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor
                                INNER JOIN asignatura ON asignatura.id_asignatura = clase.id_asignatura
                                WHERE profesor.rut_usr = '$_SESSION[rut_usr]' AND curso.id_curso = $dato3[id_curso]";
                            $res_as3 = $dbcon -> query($sql_as3);
                            while ($dato_as3 = mysqli_fetch_array($res_as3)) {
                                echo "
                            <li class=\"dropdown-submenu\"><a>$dato_as3[nombre_asignatura]</a>
                                <ul class=\"dropdown-menu\">
                                      <li><a href=\"ingresar_notas.php?curso=$dato_as3[id_curso]&asig=$dato_as3[id_asignatura]\">Ingresar notas</a></li>
                                      <li><a href=\"ver_notas_asignatura.php?curso=$dato_as3[id_curso]&asig=$dato_as3[id_asignatura]\">Ver notas</a></li>  
                                </ul>
                            </li>
                                ";
                            }
                            echo"    
                            </ul>
                        </li>";
                        }
                        $res3->close();
                        ?>
                    </ul>
                </li>

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
                        <li><a href="ver_perfil_profesor.php">Ver Perfil</a></li>
                        <li><a href="modificar_pass_profesor.php">Cambiar Contraseña</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
                    </ul>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>