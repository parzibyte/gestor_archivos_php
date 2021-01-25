<?php

namespace Parzibyte;

use PDO;

class BD
{
    static function obtener()
    {
        $password = Utiles::obtenerVariableDelEntorno("MYSQL_PASSWORD");
        $user = Utiles::obtenerVariableDelEntorno("MYSQL_USER");
        $dbName = Utiles::obtenerVariableDelEntorno("MYSQL_DATABASE_NAME");
        $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
        $database->query("set names utf8;");
        $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $database;
    }
}