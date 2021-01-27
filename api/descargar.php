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
Gestor::servirArchivoParaDescargar($idArchivo);
