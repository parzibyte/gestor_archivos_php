# Gestor de archivos en la nube con PHP
Gestor de archivos con PHP. Permite la subida y descarga de archivos con login, y la compartición de los mismos. Algo como un Google Drive, Mega, OneDrive o Dropbox pero de manera básica.
![Archivos en la nube con software escrito en PHP](https://parzibyte.me/blog/wp-content/uploads/2021/01/Archivos-en-la-nube-con-software-escrito-en-PHP.png)

Archivos en la nube con software escrito en PHP
# Documentación e instalación

Lo encuentras en el tutorial: 
https://parzibyte.me/blog/2021/01/27/software-gestor-archivos-nube-php-mysql/

# Posibles implicaciones de seguridad sobre archivos públicos

Existe la posibilidad de que los hashes se repitan en algún momento a través de toda la historia y uso del software; y que un enlace de descarga que llevaba a otro archivo (ahora ya no compartido), lleve a uno nuevo que se cree secreto.

No me refiero a que los hashes no sean seguros, te invito a leer el código en caso de que pienses eso.

Todo esto depende de la aleatoridad de los hashes. No he sacado el cálculo, pero sé que es totalmente posible que ocurra, aunque muy poco probable.

Para solucionarlo, en lugar de eliminar los valores de la tabla `archivos_compartidos`
se podría marcar como `eliminado` y así se contaría con la certeza de que no hay hash repetido en ningún momento de la historia del software
