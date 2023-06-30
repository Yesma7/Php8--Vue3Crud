<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Importamos la Conexión a la BD y la clase
include_once '../config/database.php';
include_once '../class/empleados.php';

//Conexión a BD
$database = new Database();
$db = $database->getConnection();

//Variables Datos
$item = new Empleados($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();

//Invocamos a la función
$item->obtenerUno();

if ($item->nombre != null) {
    //Array para almacenar los datos del empleado

    $empleadoDatos = array(
        "id" => $item->id,
        "nombre" => $item->nombre,
        "apellido" => $item->apellido,
        "correo" => $item->correo
    );

    http_response_code(200);
    echo json_encode($empleadoDatos);
} else {
    http_response_code(404);
    echo json_encode(
        array("msg" => "Ups! Algo salió mal :(")
    );
}
