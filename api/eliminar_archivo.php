<?php


use Parzibyte\Gestor;

include_once "vendor/autoload.php";
include_once "salir_si_no_logueado.php";
include_once "cors.php";
$id = json_decode(file_get_contents("php://input"));
if (!$id) {
    exit("No hay ID");
}
if (!Gestor::archivoPerteneceAUsuarioLogueado($id)) {
    exit("El archivo no existe o no tienes permiso para eliminarlo");
}
echo json_encode(Gestor::eliminarArchivo($id));
