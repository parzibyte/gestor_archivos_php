<?php
$ubicacion = "./subidas/80683b7b-3273-45c2-8060-86c61bf36618";
$nombreOriginal = "app.py";
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=$nombreOriginal");
readfile($ubicacion);
