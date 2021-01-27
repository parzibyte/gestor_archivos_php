<?php

use Parzibyte\Usuarios;

include_once "vendor/autoload.php";
include_once "cors.php";
include_once "salir_si_no_logueado.php";
include_once "salir_si_no_es_administrador.php";
$datos = json_decode(file_get_contents("php://input"));
if (!$datos) {
    http_send_status(500);
    exit();
}

$respuesta = Usuarios::cambiarPalabraSecreta($datos->idUsuario, $datos->palabraSecretaActual, $datos->nuevaPalabraSecreta);
echo json_encode($respuesta);
