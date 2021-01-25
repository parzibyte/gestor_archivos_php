<?php

include_once "vendor/autoload.php";
include_once "cors.php";
include_once "salir_si_no_logueado.php";

use Parzibyte\Gestor;

$respuesta = Gestor::procesarArchivos($_FILES["archivos"]);
echo json_encode($respuesta);