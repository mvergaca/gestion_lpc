<link rel="stylesheet" type="text/css" href="css/estilos.css">

<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $rut = $_POST['rut'];

    $sql = "SELECT * FROM usuario WHERE rut_usr = '$rut'";
    $res = $dbcon ->query($sql);

    $sql2 = "SELECT * FROM administrador WHERE rut_usr = '$rut'";
    $res2 = $dbcon -> query($sql2);

    if(mysqli_num_rows($res2)>0){
        $tipo_usuario = "Administrador";
    }
    $res2 ->close();

    $sql3 = "SELECT * FROM alumno WHERE rut_usr = '$rut'";
    $res3 = $dbcon -> query($sql3);

    if(mysqli_num_rows($res3)>0){
        $tipo_usuario = "Alumno";
    }
    $res3->close();

    $sql4 = "SELECT * FROM apoderado WHERE rut_usr = '$rut'";
    $res4 = $dbcon -> query($sql4);

    if(mysqli_num_rows($res4)>0){
        $tipo_usuario = "Apoderado";
    }
    $res4->close();

    $sql5 = "SELECT * FROM asistente WHERE rut_usr = '$rut'";
    $res5 = $dbcon -> query($sql5);

    if(mysqli_num_rows($res5)>0){
        $tipo_usuario = "Asistente";
    }
    $res5 ->close();

    $sql6 = "SELECT * FROM director WHERE rut_usr = '$rut'";
    $res6 = $dbcon -> query($sql6);

    if(mysqli_num_rows($res6)>0){
        $tipo_usuario = "Director";
    }
    $res6 ->close();

    $sql7 = "SELECT * FROM profesor WHERE rut_usr = '$rut'";
    $res7 = $dbcon -> query($sql7);

    if(mysqli_num_rows($res7)>0){
        $tipo_usuario = "Profesor";
    }
    $res7 ->close();

    $sql8 = "SELECT * FROM secretaria WHERE rut_usr = '$rut'";
    $res8 = $dbcon -> query($sql8);

    if(mysqli_num_rows($res8)>0){
        $tipo_usuario = "Secretaria";
    }
    $res8 ->close();

    $sql9 = "SELECT * FROM utp WHERE rut_usr = '$rut'";
    $res9 = $dbcon -> query($sql9);

    if(mysqli_num_rows($res9)>0){
        $tipo_usuario = "Utp";
    }
    $res9 ->close();

    if(empty($tipo_usuario)){
        $tipo_usuario = "Vacio";
    }
    if(mysqli_num_rows($res) > 0){
        while ($dat = mysqli_fetch_array($res)){
            $rut = $dat["rut_usr"];

                $rut_usr = $dat["rut_usr"];
                $nombre =$dat["nombre_usr"];
                $apellido_p =$dat["apellido_p_usr"];
                $apellido_m =$dat["apellido_m_usr"];
                $fecha_n =$dat["fecha_n_usr"];
                $genero =$dat["genero_usr"];
                $telefono =$dat["telefono_usr"];
                $correo =$dat["correo_usr"];
                $direccion =$dat["direccion_usr"];
                $comuna =$dat["comuna_usr"];
        }

        echo"|1|<table class='table table-responsive table-bordered' style='background-color: #f7ecb5; border: #34a9b6 2px solid;'>
                        <tr id='dato'>
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Rut</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $rut_usr
                            </td>
                        </tr>  
                        <tr id='dato'>  
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Nombre</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $nombre
                            </td>
                        </tr>  
                        <tr id='dato'>  
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Apellido Paterno</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $apellido_p
                            </td>
                        </tr>  
                        <tr id='dato'>  
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Apellido Materno</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $apellido_m
                            </td>
                        </tr>  
                        <tr id='dato'>     
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Fecha Nacimiento</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $fecha_n
                            </td>
                        </tr>  
                        <tr id='dato'>     
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Genero</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $genero
                            </td>
                        </tr>  
                        <tr id='dato'>     
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Telefono</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $telefono
                            </td>
                        </tr>  
                        <tr id='dato'>     
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Correo</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $correo
                            </td>
                        </tr>  
                        <tr id='dato'>     
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Direccion</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $direccion
                            </td>
                        </tr>  
                        <tr id='dato'>     
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Comuna</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $comuna
                            </td>
                        </tr>    
                        <tr id='dato'>    
                            <td style='border: #34a9b6 2px solid;'>
                            <label>Tipo de usuario</label>
                            </td>
                            <td style='border: #34a9b6 2px solid;'>
                                $tipo_usuario
                            </td>
                        </tr>";

        echo"</table>
            <div style='margin-top: 3%' class='col-sm-offset-3 col-sm-6'>";

            if(strcmp($tipo_usuario,"Alumno") == 0 || strcmp($tipo_usuario,"Profesor") == 0){
                echo"<input type='button' class='btn btn-success' value='Ver' id='ver'>";
            }
            echo"<input type='hidden' id='id_usr' value='$rut'>
            <input type='button' class='btn btn-info' value='Editar' id='editar'>
            <input type='button' class='btn btn-danger' value='Eliminar' id='eliminar'>
            </div>|";
    }
    else{
        echo"|-1|";

    }

    $res->close();
    include "cerrar_conexion.php";
}
?>