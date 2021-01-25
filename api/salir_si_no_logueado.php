<?php

use Parzibyte\Sesion;

include_once "vendor/autoload.php";
if (!Sesion::sesionEstaActiva()) {
    http_response_code(401);
    exit;
}
