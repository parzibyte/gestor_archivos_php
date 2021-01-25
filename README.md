# gestor_archivos_php

Gestor de archivos con PHP. Permite la subida y descarga de archivos con login, y la compartición de los mismos (trabajo
en progreso)

# Instalación

Además de lo como la creación del archivo **env.php**, instalación de dependencias e importación del esquema, hay
ciertos puntos a considerar

1. Configurar el directorio en donde estarán todos los archivos. Por defecto es en la carpeta **subidas** en el
   directorio raíz

2. Proteger directorio con Apache o el servidor que se esté usando, así no se permiten las descargas sin autorización.
   Lo siguiente puede ser el ejemplo del **.htaccess**:

```apacheconf
Allow from None
Order allow,deny
```

3. Recuerda ajustar las variables `post_max_size`, `upload_max_filesize`, `memory_limit` y `max_file_uploads` en el archivo
   **php.ini** según tus necesidades.
   
   `memory_limit` debería ser mayor que `post_max_size` y `upload_max_filesize`
