<?php

use Parzibyte\CompartirArchivo;
use Parzibyte\Gestor;

if (!isset($_GET["hash"])) {
    exit("No hay hash");
}
include_once "vendor/autoload.php";
$hash = $_GET["hash"];
$detalles = CompartirArchivo::obtenerDetallesPublicosArchivoCompartido($hash);
if (!$detalles) {
    exit("El archivo solicitado no existe o se ha dejado de compartir");
}
Gestor::servirArchivoParaDescargar($detalles->id);