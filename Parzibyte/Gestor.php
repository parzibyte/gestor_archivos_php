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
            }
        }
    }

    static function guardarArchivoEnBaseDeDatos($nombreOriginal, $nombreReal, $tamanio)
    {
        // TODO: tomarlo de la sesión
        $idUsuario = 1;
        $bd = BD::obtener();
        $sentencia = $bd->prepare("INSERT INTO archivos(nombre_original, nombre_real, fecha_creacion, tamanio_bytes, id_usuario) VALUES (?, ?, ?, ?, ?)");
        $fechaYHora = date("Y-m-d H:i:s");
        return $sentencia->execute([$nombreOriginal, $nombreReal, $fechaYHora, $tamanio, $idUsuario]);
    }
}
