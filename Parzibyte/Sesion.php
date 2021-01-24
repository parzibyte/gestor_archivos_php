<?php


namespace Parzibyte;


class Sesion
{

    public static function logout()
    {
        self::iniciar();
        session_destroy();
    }

    public static function sesionEstaActiva()
    {
        self::iniciar();
        return isset($_SESSION["id"]) && isset($_SESSION["correo"]);
    }

    public static function obtenerUsuario()
    {
        self::iniciar();
        // https://parzibyte.me/blog/2021/01/23/php-convertir-arreglo-objeto/
        return (object)[
            "id" => $_SESSION["id"],
            "correo" => $_SESSION["correo"],
        ];
    }

    public static function propagarUsuario($id, $correo)
    {
        self::iniciar();
        $_SESSION["id"] = $id;
        $_SESSION["correo"] = $correo;
    }

    public static function iniciar()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
            session_regenerate_id(true);
        }
    }

}