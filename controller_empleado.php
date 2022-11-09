<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
include("empleado.php");

$empleado = new empleadoServices();
$result = "API PHP";
$req = json_decode(file_get_contents("php://input"), true);

switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        $result = $empleado->listar();
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
