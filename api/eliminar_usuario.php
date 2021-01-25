<?php


use Parzibyte\Usuarios;

include_once "vendor/autoload.php";
include_once "salir_si_no_logueado.php";
include_once "salir_si_no_es_administrador.php";
include_once "cors.php";
$id = json_decode(file_get_contents("php://input"));
if (!$id) {
    exit("No hay ID");
}
echo json_encode(Usuarios::eliminar($id));
