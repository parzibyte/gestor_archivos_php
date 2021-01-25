<?php

include_once "vendor/autoload.php";
include_once "cors.php";
include_once "salir_si_no_logueado.php";

use Parzibyte\Gestor;

$archivos = Gestor::obtenerArchivosDeUsuarioLogueado();
echo json_encode($archivos);
