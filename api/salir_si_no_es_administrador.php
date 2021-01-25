<?php
use Parzibyte\Sesion;

include_once "vendor/autoload.php";
if (!Sesion::esAdministrador()) {
    http_response_code(403);
    exit;
}
