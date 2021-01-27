<?php


namespace Parzibyte;


class Seguridad
{
    static function cadenaSeguraAleatoria()
    {
        $longitud = 20;
        return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
    }

    static function hashearPalabraSecreta($palabraSecreta)
    {
        return password_hash(self::prepararPalabraSecretaPlana($palabraSecreta), PASSWORD_BCRYPT);
    }

    static function verificarPalabraSecreta($palabraSecreta, $hash)
    {
        return password_verify(self::prepararPalabraSecretaPlana($palabraSecreta), $hash);
    }

    static function prepararPalabraSecretaPlana($palabraSecreta)
    {
        return hash("sha256", $palabraSecreta);
    }
}