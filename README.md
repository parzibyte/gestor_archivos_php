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

3. Recuerda ajustar las variables `post_max_size`, `upload_max_filesize`, `memory_limit` y `max_file_uploads` en el
   archivo
   **php.ini** según tus necesidades.

   `memory_limit` debería ser mayor que `post_max_size` y `upload_max_filesize`, aunque en el caso de las descargas he
   probado con archivos de hasta **2.59 GB** y no hay problemas, teniendo `128M` como valor en `memory_limit`

# Preparando para producción

Ejecutar `npm run build` y copiar al servidor de producción solo la carpeta **api** y todos los archivos generados
dentro de **frontend/dist**.

**Lee bien**: debes copiar todos los archivos generados de manera que estos sean hermanos de la carpeta **api**, y no
solo copiar la carpeta llamada **dist**. Solo como referencia, el directorio de producción en mi caso
es ``gestor_archivos_php_prod`` y se ve así:

````
λ tree gestor_archivos_php_prod
Listado de rutas de carpetas
El número de serie del volumen es 
C:\XAMPP\HTDOCS\GESTOR_ARCHIVOS_PHP_PROD
├───api
│   ├───Parzibyte
│   ├───subidas
│   └───vendor
│       ├───bin
│       ├───brick
│       │   └───math
│       │       └───src
│       │           ├───Exception
│       │           └───Internal
│       │               └───Calculator
│       ├───composer
│       ├───ramsey
│       │   ├───collection
│       │   │   ├───bin
│       │   │   └───src
│       │   │       ├───Exception
│       │   │       ├───Map
│       │   │       └───Tool
│       │   └───uuid
│       │       └───src
│       │           ├───Builder
│       │           ├───Codec
│       │           ├───Converter
│       │           │   ├───Number
│       │           │   └───Time
│       │           ├───Exception
│       │           ├───Fields
│       │           ├───Generator
│       │           ├───Guid
│       │           ├───Lazy
│       │           ├───Math
│       │           ├───Nonstandard
│       │           ├───Provider
│       │           │   ├───Dce
│       │           │   ├───Node
│       │           │   └───Time
│       │           ├───Rfc4122
│       │           ├───Type
│       │           └───Validator
│       └───symfony
│           └───polyfill-ctype
├───css
├───fonts
└───js
````

Una vez que hayas copiado **api**, edita el archivo **cors.php** y establece la variable ``produccion``
en ``true``

# Posibles implicaciones de seguridad sobre archivos públicos

Existe la posibilidad de que los hashes se repitan en algún momento a través de toda la historia y uso del software; y
que un enlace de descarga que llevaba a otro archivo (ahora ya no compartido), lleve a uno nuevo que se cree secreto.

No me refiero a que los hashes no sean seguros, te invito a leer el código en caso de que pienses eso.

Todo esto depende de la aleatoridad de los hashes. No he sacado el cálculo, pero sé que es totalmente posible que
ocurra, aunque muy poco probable.

Para solucionarlo, en lugar de eliminar los valores de la tabla `archivos_compartidos`
se podría marcar como `eliminado` y así se contaría con la certeza de que no hay hash repetido en ningún momento de la
historia del software
