<?php

class Database
{

    private $host = "127.0.0.1"; //Host BD
    private $database_name = "crudphp"; //Nombre Base de Datos
    private $username = "root"; //Usuario
    private $password = ""; //Contraseña - Si tenemos asignada escribirla

    public $conn;

    //Función para conectarnos con la BD
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Ups! Hay un problema: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
