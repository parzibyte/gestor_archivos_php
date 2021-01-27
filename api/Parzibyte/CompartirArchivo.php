<?php


namespace Parzibyte;


class CompartirArchivo
{

    static function obtenerDetallesPublicosArchivoCompartido($hash)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("SELECT archivos.id FROM archivos
INNER JOIN archivos_compartidos ON archivos.id = archivos_compartidos.id_archivo
WHERE archivos_compartidos.hash = ?");
        $sentencia->execute([$hash]);
        return $sentencia->fetchObject();
    }

    static function obtenerDetallesArchivoCompartido($idArchivo)
    {
        if (!Gestor::archivoPerteneceAUsuarioLogueado($idArchivo)) {
            return null;
        }
        $bd = BD::obtener();
        $sentencia = $bd->prepare("SELECT hash, id_archivo FROM archivos_compartidos WHERE id_archivo = ? LIMIT 1");
        $sentencia->execute([$idArchivo]);
        return $sentencia->fetchObject();
    }

    static function compartirArchivo($idArchivo)
    {
        if (!Gestor::archivoPerteneceAUsuarioLogueado($idArchivo)) {
            return false;
        }
        if (self::obtenerDetallesArchivoCompartido($idArchivo)) {
            // Ya está compartido
            return false;
        }
        $hash = self::obtenerHashUnicoParaCompartir();
        $bd = BD::obtener();
        $sentencia = $bd->prepare("INSERT INTO archivos_compartidos(hash, id_archivo) VALUES(?,?)");
        return $sentencia->execute([$hash, $idArchivo]);
    }

    static function obtenerHashUnicoParaCompartir()
    {
        do {
            $hash = Seguridad::cadenaSeguraAleatoria();
        } while (self::existeArchivoCompartidoPorHash($hash));
        return $hash;
    }

    static function existeArchivoCompartidoPorHash($hash)
    {

        $bd = BD::obtener();
        $sentencia = $bd->prepare("SELECT COUNT(*) AS conteo FROM archivos_compartidos WHERE hash = ? LIMIT 1");
        $sentencia->execute([$hash]);
        return $sentencia->fetchObject()->conteo > 0;
    }

}