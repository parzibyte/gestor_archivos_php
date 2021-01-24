<?php

use Parzibyte\Sesion;
use Parzibyte\Usuarios;

include_once "vendor/autoload.php";
include_once "cors.php";
include_once "salir_si_no_logueado.php";
$datos = json_decode(file_get_contents("php://input"));
if (!$datos) {
    http_response_code(500);
    exit;
}
if (!Sesion::esAdministrador()) {
    http_response_code(403);
    exit;
}
$correo = $datos->correo;
$palabraSecreta = $datos->palabraSecreta;
$administrador = $datos->administrador;
$ok = Usuarios::agregarUsuario($correo, $palabraSecreta, $administrador);
echo json_encode($ok);
