# Php8--Vue3Crud
CRUD (Create, Read, Update, Delete) construido principalmente con el siguiente stack: 
* Php 8 - PDO
* Vue Js
* MySql

Adicional cuenta con recursos como SweetAlert 2 y FontAwesome para que se vea un poco
más interesante.

Recomiendo que los archivos los crees en el siguiente orden:

    |**** api

        |__actualizar.php
    
        |__crear.php
    
        |__eliminar.php
    
        |__leer_todos.php
    
        |__leer_uno.php


    |**** class

        |__empleado.php


    |**** config
        |__database.php
    



Para que puedas ejecutar tu proyecto debes de crear tu BD (Base de Datos), puedes utilizar
PhpMyAdmin o puedes hacerlo a través de los comandos SQL.


* Crear DB:
  
      CREATE DATABASE nombre_BD;

* Crear Tabla empleados:
  
      USE nombre_BD;

      CREATE TABLE IF NOT EXISTS empleados (
  
          id INT(10) NOT NULL AUTO_INCREMENT,
  
          nombre VARCHAR(255) NOT NULL,
  
          apellido VARCHAR(255) NOT NULL,
  
          correo VARCHAR(255) NOT NULL,
  
          PRIMARY KEY(id)
  
          );

Recuerda en el archivo database.php ubicado en la carpeta config cambiar el nombre por el de tu preferencia:

      private $database_name = "nombre_DB"; //Nombre Base de Datos

Ahora, para iniciar el servidor PHP, puedes hacerlo de dos formas, ya sea con WAMP, MAMP o la herramienta que uses o,
el siguiente comando en la terminal. Ten en cuenta, debes estar en el directorio del proyecto.

        cd carpeta_proyecto/server
        
        php -S 127.0.0.1:8080

Para visualizar el Frontend:

        cd carpeta_proyecto/client

        npm run serve
