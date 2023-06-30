<?php

class Empleados
{
    //Variable Conexión
    private $conn;

    //Nombre de la tabla
    private $tabla_bd = "empleados";

    //Columnas de la tabla
    public $id;
    public $nombre;
    public $apellido;
    public $correo;

    //Conexión a BD
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Operaciones CRUD (Create, Read, Update, Delete)

    //Obtener todos los registros
    public function obtenerTodos()
    {
        $sqlQuery = "SELECT id, nombre, apellido, correo FROM " . $this->tabla_bd . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    //Obtener un solo registro
    public function obtenerUno()
    {
        $sqlQuery = "SELECT * FROM " . $this->tabla_bd . " WHERE id=? LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        //Bind - Enlazar Variables
        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $filaDato = $stmt->fetch(PDO::FETCH_ASSOC);

        //Relación de datos a variables
        $this->nombre = $filaDato['nombre'];
        $this->apellido = $filaDato['apellido'];
        $this->correo = $filaDato['correo'];
    }

    //Crear
    public function crear()
    {
        $sqlQuery = "INSERT INTO " . $this->tabla_bd . "
        SET nombre=:nombre,
        apellido=:apellido,
        correo=:correo ";

        $stmt = $this->conn->prepare($sqlQuery);

        //Sanitización
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->correo = htmlspecialchars(strip_tags($this->correo));

        //Bind - Enlazar Variables
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":correo", $this->correo);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //Actualizar
    public function actualizar()
    {
        $sqlQuery = "UPDATE " . $this->tabla_bd . "
        SET nombre=:nombre,
        apellido=:apellido,
        correo=:correo
        WHERE id=:id";

        $stmt = $this->conn->prepare($sqlQuery);

        //Sanitización
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind - Enlazar Variables
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //Eliminar
    public function eliminar()
    {
        $sqlQuery = 'DELETE FROM ' . $this->tabla_bd . ' WHERE id=?';

        $stmt = $this->conn->prepare($sqlQuery);

        //Sanitización
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind - Enlazar Variables
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
