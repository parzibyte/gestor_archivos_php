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
$tamanio = intval(sprintf("%u", filesize($rutaAbsoluta)));;
$tamanioFragmento = 5 * (1024 * 1024); //5 MB
set_time_limit(300);
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Pragma: no-cache");
header('Content-Length: ' . filesize($rutaAbsoluta));
header(sprintf('Content-disposition: attachment; filename="%s"', $archivo->nombre_original));
// Servir el archivo en fragmentos, en caso de que el tamaño del mismo sea mayor que el tamaño del fragmento
if ($tamanio > $tamanioFragmento) {
    $handle = fopen($rutaAbsoluta, 'rb');

    while (!feof($handle)) {
        print(@fread($handle, $tamanioFragmento));

        ob_flush();
        flush();
    }
    fclose($handle);
} else {
    readfile($rutaAbsoluta);
}
