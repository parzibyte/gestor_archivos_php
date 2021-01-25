<?php

use Parzibyte\Sesion;

include_once "vendor/autoload.php";
include_once "salir_si_no_logueado.php";
include_once "cors.php";
Sesion::logout();
echo json_encode(true);