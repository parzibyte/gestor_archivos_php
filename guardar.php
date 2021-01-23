<?php

include_once "vendor/autoload.php";
include_once "cors.php";

use Parzibyte\Gestor;

$respuesta = Gestor::procesarArchivos($_FILES["archivos"]);
echo json_encode($respuesta);
