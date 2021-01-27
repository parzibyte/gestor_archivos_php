CREATE TABLE IF NOT EXISTS usuarios
(
    id              BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    correo          VARCHAR(255)    NOT NULL UNIQUE,
    palabra_secreta VARCHAR(255)    NOT NULL,
    administrador   SMALLINT        NOT NULL
);

CREATE TABLE IF NOT EXISTS archivos
(
    id              BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_original VARCHAR(1024)   NOT NULL,
    nombre_real     VARCHAR(36)     NOT NULL,
    fecha_creacion  VARCHAR(19)     NOT NULL,
    tamanio_bytes   BIGINT UNSIGNED NOT NULL,
    id_usuario      BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS archivos_compartidos
(
    hash       VARCHAR(20)    NOT NULL PRIMARY KEY,
    id_archivo BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (id_archivo) REFERENCES archivos (id) ON DELETE CASCADE ON UPDATE CASCADE
);

/*
Usuario administrador por defecto
parzibyte@gmail.com
123
*/
INSERT INTO `usuarios`
VALUES (1, 'parzibyte@gmail.com', '$2y$10$I6/Sw1DZCdLZXJqHq46YYeoCfYYnEMFBx193k/sxQerK2tmA3fB4u', 1);