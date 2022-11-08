<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include("producto.php");

$producto = new producto();
$result = "API PHP";
$req = json_decode(file_get_contents("php://input"), true);

$json = array();
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        $result = $producto->listar_productos();
        $conteo = count($result);

        $json["Productos"][] = $result;
        echo json_encode($json);


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
