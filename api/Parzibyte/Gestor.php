<?php

namespace Parzibyte;

use Ramsey\Uuid\Uuid;

class Gestor
{
    static function obtenerUbicacion()
    {
        // Es un directorio arriba, en la carpeta subidas
        // Nota: esta ubicación debe existir
        return dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "subidas";
    }

    static function procesarArchivos($archivos)
    {
        $cantidadArchivos = count($archivos["name"]);
        for ($i = 0; $i < $cantidadArchivos; $i++) {
            $nombreArchivo = $archivos["name"][$i];
            $ubicacionTemporal = $archivos["tmp_name"][$i];
            $tamanio = filesize($ubicacionTemporal);
            $uuid = Uuid::uuid4();
            $nuevoNombre = $uuid->toString();
            $nuevaUbicacion = self::obtenerUbicacion() . DIRECTORY_SEPARATOR . $nuevoNombre;
            $ok = move_uploaded_file($ubicacionTemporal, $nuevaUbicacion);
            if ($ok) {
                self::guardarArchivoEnBaseDeDatos($nombreArchivo, $nuevoNombre, $tamanio);
            } else {
                return false;
            }
        }
        return true;
    }

    static function guardarArchivoEnBaseDeDatos($nombreOriginal, $nombreReal, $tamanio)
    {
        $idUsuario = Sesion::obtenerUsuario()->id;
        $bd = BD::obtener();
        $sentencia = $bd->prepare("INSERT INTO archivos(nombre_original, nombre_real, fecha_creacion, tamanio_bytes, id_usuario) VALUES (?, ?, ?, ?, ?)");
        $fechaYHora = date("Y-m-d H:i:s");
        return $sentencia->execute([$nombreOriginal, $nombreReal, $fechaYHora, $tamanio, $idUsuario]);
    }

    static function obtenerArchivosDeUsuarioLogueado()
    {
        return self::obtenerArchivosDeUsuario(Sesion::obtenerUsuario()->id);
    }

    static function obtenerArchivosDeUsuario($idUsuario)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("SELECT id, nombre_original, nombre_real, fecha_creacion, tamanio_bytes FROM archivos WHERE id_usuario = ? ORDER BY fecha_creacion DESC");
        $sentencia->execute([$idUsuario]);
        return $sentencia->fetchAll();
    }
}