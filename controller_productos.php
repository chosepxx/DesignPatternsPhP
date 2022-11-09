<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
include("producto.php");

$producto = new producto();
$result = "API PHP";
$req = json_decode(file_get_contents("php://input"), true);

$json = array();
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        if ((isset($_GET["id"]))) {

            $result = $producto->buscar_por_id($_GET["id"]);
            echo json_encode($result);
        } else {
            $result = $producto->listar_productos();
            $conteo = count($result);

            echo json_encode($result);
        }
        break;
    case "POST":
        $result = $producto->insertar($req);
        break;
    case "PUT":
        $result = $producto->actualizar($req);
        break;
    case "DELETE":
        $result = $producto->eliminar($req["id_producto"]);
        break;
}
