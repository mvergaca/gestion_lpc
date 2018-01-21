<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    if(isset($_GET['ref']) && !empty($_GET['ref'])){
        $ruta = $_GET['ref'];
        $archivo = basename($_GET['ref']);

        if (is_file($ruta))
        {
            header('Content-Type: application/force-download');
            header('Content-Disposition: attachment; filename='.$archivo);
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: '.filesize($ruta));

            readfile($ruta);

        }
        else {
            exit();
        }
    }
    else{
        exit();
    }
}
?>