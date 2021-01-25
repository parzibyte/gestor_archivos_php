<?php

use Parzibyte\Usuarios;

include_once "vendor/autoload.php";
include_once "cors.php";
include_once "salir_si_no_logueado.php";
include_once "salir_si_no_es_administrador.php";


$usuarios = Usuarios::todos();
echo json_encode($usuarios);
