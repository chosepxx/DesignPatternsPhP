<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include("registro_pintura.php");

    $registro_pintura = new registro_pintura();
    $result = "API PHP";
    $req = json_decode(file_get_contents("php://input"), true);


    switch($_SERVER['REQUEST_METHOD']){

        case "GET":
            if(empty($req["id_registro"]) == false){
                $registro_pintura->buscar_registro();
            }else{
                $result = $registro_pintura->listar();
               // echo $result;

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
  

?>