<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include("cliente.php");

$cliente = new cliente();
$result = "API PHP";
$req = json_decode(file_get_contents("php://input"), true);

switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        $result = $cliente->listar();
        $conteo = count($result);

        echo json_encode($result);


        break;
    case "POST":
        // $result = $producto->insertar($req);
        break;
    case "PUT":
        // $result = $producto->actualizar($req); 
        break;
    case "DELETE":
        // $result = $producto->eliminar($req["codigo_producto"]); 
        break;
}