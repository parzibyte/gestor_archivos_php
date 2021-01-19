<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferencia de archivos</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data" action="guardar.php">

        <input multiple type="file" name="archivos[]">
        <br><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>