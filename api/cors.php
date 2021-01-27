<?php
# Nota: establece esta variable en true cuando vayas a pasar a producción, tanto por seguridad
# como porque el sistema fallará si no lo haces, ya que no habrá HTTP_ORIGIN
$produccion = false;
if (!$produccion) {
    $dominioPermitido = $_SERVER['HTTP_ORIGIN'];
    header("Access-Control-Allow-Origin: $dominioPermitido");
    header("Access-Control-Allow-Headers: content-type");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: OPTIONS,GET,PUT,POST,DELETE");
}
