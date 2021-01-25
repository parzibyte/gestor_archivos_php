<?php

namespace Parzibyte;

use Exception;

class Utiles
{
    static function obtenerVariableDelEntorno($clave)
    {

        if (defined("_ENV_CACHE")) {
            $vars = _ENV_CACHE;
        } else {
            $archivo = "env.php";
            if (!file_exists($archivo)) {
                throw new Exception("El archivo de las variables de entorno ($archivo) no existe. Favor de crearlo");
            }
            $vars = parse_ini_file($archivo);
            define("_ENV_CACHE", $vars);
        }
        if (isset($vars[$clave])) {
            return $vars[$clave];
        } else {
            throw new Exception("La clave especificada (" . $clave . ") no existe en el archivo de las variables de entorno");
        }
    }
}
