<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT,OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
include("productoServices.php");

$producto = new productoServices();

$result = "API PHP";
$req = json_decode(file_get_contents("php://input"), true);

$json = array();
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        if ((isset($_GET["id"]))) {

            $result = $producto->buscar_por_id($_GET["id"]);
            echo json_encode($result);
        }  else {
            $result = $producto->listar_productos();
            $conteo = count($result);

            echo json_encode($result);
            http_response_code(200);
        }
        break;
    case "POST":
        $result = $producto->insertar($req);
        break;
    case "PUT":
        $result = $producto->actualizar($req);
        if ($result) {
            echo "OK";
            http_response_code(200);
        }

        break;
    case "DELETE":
        $result = $producto->eliminar($req["id_producto"]);
        break;
}
