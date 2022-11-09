<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    include("registro_pintura.php");

    $registro_pintura = new registro_pintura();
    $result = "API PHP";
    $req = json_decode(file_get_contents("php://input"), true);
    $json = array();

    switch($_SERVER['REQUEST_METHOD']){

        case "GET":
            if(empty($req["id_registro"]) == false){
                $result = $registro_pintura->buscar_registro();
             //   $json["Registros"][] = $result;
              //  echo json_encode($json);
                echo json_encode($result);
            }else{
                $result = $registro_pintura->listar();
                echo json_encode($result);

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
