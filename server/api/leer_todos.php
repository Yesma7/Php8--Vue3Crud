<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Importamos la Conexión a la BD y la clase
include_once '../config/database.php';
include_once '../class/empleados.php';

//Conexión a BD
$database = new Database();
$db = $database->getConnection();

//Variables Datos
$items = new Empleados($db);

//Invocamos a la función
$stmt = $items->obtenerTodos();
$itemConteo = $stmt->rowCount();

if ($itemConteo > 0) {
    $empleadosLista = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        //Array para almacenar los datos del empleado
        $e = array(
            "id" => $id,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "correo" => $correo
        );

        array_push($empleadosLista, $e);
    }

    echo json_encode($empleadosLista);
} else {
    http_response_code(404);
    echo json_encode(
        array("msg" => "Oh no! No encontré registro")
    );
}
