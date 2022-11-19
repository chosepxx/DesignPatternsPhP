<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, PUT,OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
require 'vendor/autoload.php';


$registro_pintura = new registro_pinturaServices();
$result = "API PHP";
$req = json_decode(file_get_contents("php://input"), true);
$json = array();

switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        if ((isset($_GET["id"]))) {
            $result = $registro_pintura->buscar_por_id($_GET["id"]);
            //   $json["Registros"][] = $result;
            //  echo json_encode($json);
            echo json_encode($result);
        } else {

            $result = $registro_pintura->listar();
       //     $recOb = new RecordObservable();

            //lo que debo de poner, estoy haciendo pruebas
            echo json_encode($result);
            //  echo "",$tamanio;

        }

        break;
    case "POST":
        $result = $registro_pintura->insertar($req);
        break;
    case "PUT":
        $result = $registro_pintura->actualizar($req);
        break;
    case "DELETE":
        $result = $registro_pintura->eliminar($req["id_registro"]);
        break;
}
