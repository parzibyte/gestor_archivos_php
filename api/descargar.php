<?php

use Parzibyte\Gestor;

include_once "vendor/autoload.php";
include_once "salir_si_no_logueado.php";
if (!isset($_GET["id"])) {
    exit("No hay ID");
}
$idArchivo = $_GET["id"];
if (!Gestor::archivoPerteneceAUsuarioLogueado($idArchivo)) {
    exit("El archivo no existe o no tienes permiso para verlo");
}
$archivo = Gestor::obtenerUnoPorId($idArchivo);
$rutaAbsoluta = Gestor::obtenerRutaAbsoluta($archivo->nombre_real);
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header(sprintf('Content-disposition: attachment; filename="%s"', $archivo->nombre_original));
readfile($rutaAbsoluta);
