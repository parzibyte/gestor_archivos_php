<?php

use Parzibyte\CompartirArchivo;

include_once "vendor/autoload.php";
include_once "cors.php";
include_once "salir_si_no_logueado.php";
$datos = json_decode(file_get_contents("php://input"));
if (!$datos) {
    http_send_status(500);
    exit();
}
$respuesta = CompartirArchivo::dejarDeCompartir($datos->idArchivo);
echo json_encode($respuesta);
