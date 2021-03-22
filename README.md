# PRUEBA STAMPY # 

Este proyecto está pensado para la prueba de Stampy Mail. Se realizó utilizando PHP puro junto con Html/CSS y JS.

Para poder aplicar patrones de diseño que en un proyecto real hubieran 
brindado escalabilidad y robustez al proyecto cree un Motor de inyección de dependencias y un router (que permite inyección de dependencias).


## Requisitos del sistema ##

El sistema requiere un motor de base de datos MySql y  un servidor Apache para poder correr el .htaccess que permite utilizar URLs amigables.

## Usuario administrador ##

Por defecto, la base de datos trae un usuario con el mail default@sample.com con la contraseña default123.

## COMO USAR EL SISTEMA ##

Dentro de la raíz del proyecto tenemos un archivo .sql que contiene la base de datos con un usuario por defecto y con sus stored procedures.

Dentro de la raíz del proyecto tenemos también un archivo startup.php. Dentro de ese archivo debemos definir: nombre de la base de datos, server de la base de datos, usuario y contraseña.


### Nota ###

En un proyecto real también debería aplicarse testing.
