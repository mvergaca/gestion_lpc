<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $curso = $_POST["curso"];
    $clase = $_POST["clase"];
    $horario = $_POST["horario"];
    $dia = $_POST["dia"];
    $anio = date("Y");

    $sql4 = "SELECT * FROM clase WHERE id_clase = $clase AND anio = $anio";
    $res4 = $dbcon ->query($sql4);
    while ($datos4 = mysqli_fetch_array($res4)){
        $profesor = $datos4["id_profesor"];
    }


    $sql = "SELECT * FROM clase
            INNER JOIN distribucion ON distribucion.id_clase = clase.id_clase
            INNER JOIN horario ON horario.id_horario = distribucion.id_horario
            WHERE clase.id_profesor = $profesor AND clase.id_curso = $curso AND clase.id_asignatura = $asignatura 
            AND distribucion.id_horario = $horario AND distribucion.dia = '$dia' AND clase.anio = $anio";
    $res = $dbcon -> query($sql);
    $num = mysqli_num_rows($res);


        if($num > 0){
            echo"|-1|<h4><span class=\"label label-danger\">Ya existe la asignatura en ese horario para este profesor</span></h4>|";
        }
        else{
            $sql2 = "SELECT * FROM clase
            INNER JOIN distribucion ON distribucion.id_clase = clase.id_clase
            INNER JOIN horario ON horario.id_horario = distribucion.id_horario
            WHERE clase.id_profesor = $profesor 
            AND distribucion.id_horario = $horario AND distribucion.dia = '$dia' AND clase.anio = $anio";
            $res2 = $dbcon -> query($sql2);
            $num2 = mysqli_num_rows($res2);
            if($num2 > 0){
                echo"|-1|<h4><span class=\"label label-danger\">Ya existe la asignatura en ese horario para este profesor</span></h4>|";
            }
            else{
                $sql3 = "SELECT * FROM clase
                INNER JOIN distribucion ON distribucion.id_clase = clase.id_clase
                INNER JOIN horario ON horario.id_horario = distribucion.id_horario
                WHERE clase.id_curso = $curso
                AND distribucion.id_horario = $horario AND distribucion.dia = '$dia' AND clase.anio = $anio";
                $res3 = $dbcon -> query($sql3);
                $num3 = mysqli_num_rows($res3);
                if($num3 >0){
                    echo"|-1|<h4><span class=\"label label-danger\">Ya existe la asignatura en ese horario para este curso</span></h4>|";
                }
                else {

                    $sql6 = "INSERT INTO distribucion (id_clase, id_horario, dia) VALUES ($clase,$horario,'$dia');";
                    $res6 = $dbcon->query($sql6);


                    echo "|1|";
                    /*--------------------------------------------------------------------------*/
?>
                    <table id="tabla-horario" class="table-responsive table-bordered col-sm-offset-2 col-sm-8">
                        <thead>
                        <tr>
                            <td style="width: 20%"><b>Horario</b></td>
                            <td style="width: 16%"><b>Lunes</b></td>
                            <td style="width: 16%"><b>Martes</b></td>
                            <td style="width: 16%"><b>Miércoles</b></td>
                            <td style="width: 16%"><b>Jueves</b></td>
                            <td style="width: 16%"><b>Viernes</b></td>
                        </tr>
                        </thead>
                        <?php
                        $dias = array(1 => "lunes",2 => "martes",3 => "miercoles",4 => "jueves",5 => "viernes");

                        $sql2 = "SELECT * FROM horario";
                        $res2 = $dbcon->query($sql2);

                        while($datos2 = mysqli_fetch_array($res2)) {
                            echo "<tr>";
                            echo "<td>$datos2[hora_inicio] - $datos2[hora_fin] </td>";

                            for($i = 1; $i<=5; $i++) {
                                $sql = "SElECT * FROM horario
                     LEFT JOIN distribucion ON horario.id_horario = distribucion.id_horario
                     LEFT JOIN clase ON distribucion.id_clase = clase.id_clase
                     LEFT JOIN profesor ON clase.id_profesor = profesor.id_profesor
                     LEFT JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                     LEFT JOIN curso ON clase.id_curso = curso.id_curso
                     LEFT JOIN asignatura ON clase.id_asignatura = asignatura.id_asignatura
                     WHERE curso.id_curso = $curso AND horario.id_horario = $datos2[id_horario] AND distribucion.dia = '$dias[$i]' ORDER BY horario.id_horario";
                                $res = $dbcon->query($sql) or die("no se pudo mostrar horario" . mysqli_error());

                                if(mysqli_num_rows($res) > 0){
                                    while ($datos = mysqli_fetch_array($res)) {
                                        if($datos["dia"] == "lunes"){
                                            $dia = 1;
                                        }
                                        if($datos["dia"] == "martes"){
                                            $dia = 2;
                                        }
                                        if($datos["dia"] == "miercoles"){
                                            $dia = 3;
                                        }
                                        if($datos["dia"] == "jueves"){
                                            $dia = 4;
                                        }
                                        if($datos["dia"] == "viernes"){
                                            $dia = 5;
                                        }
                                        echo "<td><span class='glyphicon glyphicon-remove-sign col-sm-offset-9 col-sm-3 col-xs-offset-9 col-xs-3' onclick='eliminar_dist($datos[id_curso],$datos[id_horario],$dia,$datos[id_clase]);'></span>$datos[nombre_asignatura] - $datos[nombre_usr] $datos[apellido_p_usr]</td>";
                                    }
                                }
                                else{
                                    echo "<td>-</td>";
                                }

                                $res->close();
                            }
                            echo "</tr>";
                        }
                        $res2 ->close();
                        ?>
                    </table>
           <?php
                    /*--------------------------------------------------------------------------*/
                    echo"|";
                }
            }
        }


    $res->close();
    include "cerrar_conexion.php";
}
?>