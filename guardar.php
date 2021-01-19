<?php

include_once "vendor/autoload.php";

use Parzibyte\Gestor;

Gestor::procesarArchivos($_FILES["archivos"]);
// echo "<pre>";
// var_dump($_FILES["archivos"]);
