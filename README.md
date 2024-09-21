# Ejercicio de Conexión a Base de Datos con PHP y PDO

Este proyecto es un ejercicio trabajado en clase para realizar una conexión a una base de datos utilizando PHP con la extensión PDO (PHP Data Objects). En este ejemplo, se realiza una lectura de datos desde una tabla llamada `TiposDocumentos`, la cual contiene los campos `id_tipoDocumento`, `codigo` y `glosa`.

## Requisitos

- PHP 7.0 o superior
- Un servidor de base de datos MySQL o MariaDB
- Extensión PDO habilitada en el servidor PHP

## Descripción del Ejercicio

El ejercicio tiene como objetivo enseñar cómo conectar una aplicación PHP a una base de datos utilizando PDO, y cómo realizar una consulta sencilla para traer datos desde la tabla `TiposDocumentos`.

### Tabla: `TiposDocumentos`

La estructura básica de la tabla `TiposDocumentos` es la siguiente:

| Campo              | Tipo         | Descripción                                  |
|--------------------|--------------|----------------------------------------------|
| `id_tipoDocumento`  | INT(11)      | Identificador único, autoincrementable y llave primaria |
| `codigo`            | VARCHAR(50)  | Código del tipo de documento                 |
| `glosa`             | VARCHAR(255) | Descripción del tipo de documento            |
