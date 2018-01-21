<?php
    session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    if (isset($_FILES['file'])) {

        $file = $_FILES['file'];
        $size = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            if ($size < (1024 * 1024)) {

                if (strpos($type, 'jpeg') || strpos($type, 'png') || strpos($type, 'jpg')
                    || strpos($type, 'gif') || strpos($type, 'pdf')){

                    $origen = $_FILES['file']['tmp_name'];
                    $destino = 'casos/'.date('d-m-Y')." ".time('h:m:s')." ".$_FILES['file']['name'];
                    move_uploaded_file($origen, $destino);


                    echo ";1;$destino;$type;";
                } else {
                    echo ";-1;Tipo de archivo no admitido;";
                }
            } else {
                echo ";-1;El tamaño del archivo es muy grande;";
            }
        } else {
            echo ";-1;no se cargo el archivo;";
        }

    } else {
        echo ";-1;no entro;";
    }
    include "cerrar_conexion.php";
}
?>