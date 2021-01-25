<?php

namespace Parzibyte;

use Parzibyte\BD;
use Parzibyte\Seguridad;

class Usuarios
{

    static function todos()
    {
        $db = BD::obtener();
        $sentencia = $db->query("SELECT id, correo, palabra_secreta, administrador FROM usuarios");
        return $sentencia->fetchAll();
    }

    public static function agregarUsuario($correo, $palabraSecreta, $administrador)
    {
        $administrador = intval($administrador);
        $palabraSecretaHasheada = Seguridad::hashearPalabraSecreta($palabraSecreta);
        $bd = BD::obtener();
        $sentencia = $bd->prepare("INSERT INTO usuarios(correo, palabra_secreta, administrador) VALUES(?, ?, ?)");
        return $sentencia->execute([$correo, $palabraSecretaHasheada, $administrador]);
    }

    static function obtenerUnoPorCorreo($correo)
    {
        $db = BD::obtener();
        $sentencia = $db->prepare("SELECT id, correo, palabra_secreta, administrador FROM usuarios WHERE correo = ?");
        $sentencia->execute([$correo]);
        return $sentencia->fetchObject();
    }

    static function login($correo, $palabraSecreta)
    {
        $usuario = self::obtenerUnoPorCorreo($correo);
        if (!$usuario) {
            return false;
        }
        return Seguridad::verificarPalabraSecreta($palabraSecreta, $usuario->palabra_secreta);
    }

    public static function eliminar($id)
    {
        self::eliminarArchivosDeUsuario($id);
        $bd = BD::obtener();
        $sentencia = $bd->prepare("DELETE FROM usuarios WHERE id = ?");
        return $sentencia->execute([$id]);
    }

    public static function eliminarArchivosDeUsuario($idUsuario)
    {
        $archivos = Gestor::obtenerArchivosDeUsuario($idUsuario);
        $bd = BD::obtener();
        $sentencia = $bd->prepare("DELETE FROM archivos WHERE id_usuario = ?");
        if (!$sentencia->execute([$idUsuario])) {
            return false;
        }
        foreach ($archivos as $archivo) {
            if (!unlink(Gestor::obtenerRutaAbsoluta($archivo->nombre_real))) {
                return false;
            }
        }
        return true;
    }
}
