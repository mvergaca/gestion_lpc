<?php

session_start();
unset($_SESSION['rut_usr']);
unset($_SESSION['nombre']);
unset($_SESSION['apellido_p']);
unset($_SESSION['apellido_m']);
$_SESSION['conectado'] = "no";

header('Location: index.php');
?>