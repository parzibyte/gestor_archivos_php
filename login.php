<?php

use Parzibyte\Sesion;
use Parzibyte\Usuarios;

include_once "vendor/autoload.php";
include_once "cors.php";
$datos = json_decode(file_get_contents("php://input"));
if (!$datos) {
    http_response_code(500);
    exit;
}
$correo = $datos->correo;
$palabraSecreta = $datos->palabraSecreta;
$ok = Usuarios::login($correo, $palabraSecreta);
if ($ok) {
    $usuario = Usuarios::obtenerUnoPorCorreo($correo);
    Sesion::propagarUsuario($usuario->id, $usuario->correo);
    echo json_encode(true);
} else {
    echo json_encode(false);
}
