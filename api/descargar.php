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
$tamanio = filesize($rutaAbsoluta);
$tamanioFragmento = 5 * (1024 * 1024); //5 MB
set_time_limit(300);
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Pragma: no-cache");
header('Content-Length: ' . $tamanio);
header(sprintf('Content-disposition: attachment; filename="%s"', $archivo->nombre_original));
// Servir el archivo en fragmentos, en caso de que el tamaño del mismo sea mayor que el tamaño del fragmento
if ($tamanio > $tamanioFragmento) {
    $manejador = fopen($rutaAbsoluta, 'rb');

    // Mientras no lleguemos al final del archivo...
    while (!feof($manejador)) {
        // Imprime lo que regrese fread, y fread leerá N cantidad de bytes en donde N es el tamaño del fragmento
        print(@fread($manejador, $tamanioFragmento));

        ob_flush();
        flush();
    }
    // Cerrar el archivo
    fclose($manejador);
} else {
    // Si el tamaño del archivo es menor que el del fragmento, podemos usar readfile sin problema
    readfile($rutaAbsoluta);
}
