<?php

namespace abstractFactory;
use productoServices;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT,OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
require_once 'vendor/autoload.php';
//include("./productoServices.php");

$producto = new productoServices();
interface ProductFactory
{
    public function createBase(): IBase;
    public function createArea(): IArea;
}


class FactoryPintura implements ProductFactory
{
    public function createBase(): IBase {
        return new Base(1);
	}
	
	
	public function createArea(): IArea {
        return new Area(1);
	}
	
	
}

class FactoryTinte implements ProductFactory
{
   

    public function createBase(): IBase {
        return new Base(0.8);
	}
	
	
	public function createArea(): IArea {
        return new Area(0.8);
	}
}



interface IBase
{
    public function getPriceByBase($base): string;
}

interface IArea
{
    public function getPriceByArea($area): string;
}


interface IProducto
{
    public function createProducto($color): string;
}

class Area implements IArea{
    public $basePrice; 
    function __construct($basePrice) {
       
        $this->basePrice = $basePrice;
        }
    
	
	public function getPriceByArea($area): string
    {
        if(strcmp($area,"Metales") == 0){
            return 10000 * $this->basePrice;
        }elseif(strcmp($area,"Techo") == 0){
            return 8000* $this->basePrice;
        }else{
            return 7000* $this->basePrice;
        }
       
    }
}

class Base implements IBase{

    public $basePrice; 
    function __construct($basePrice) {
       
        $this->basePrice = $basePrice;
        }
    
	public function getPriceByBase($base): string    {
        if(strcmp($base,"Agua") == 0){
            return 5000 * $this->basePrice;
        }elseif(strcmp($base,"Aceite") == 0){
            return 6000 * $this->basePrice;
        }else{
            return 7000 * $this->basePrice;
        }
       
    }
}

class Producto 
{
    public $area;
    public $base;
    public $color;
    public $price;
    function __construct($area,$base) {
    $this->area = $area;
    $this->base = $base;
 
    }

  
    public function getProductPrice(ProductFactory $factory): string
    {   $this->price = 0;
        $this->price += $factory->createArea()->getPriceByArea($this->area);
        $this->price += $factory->createBase()->getPriceByBase($this->base);
      
        return $this->price;
    }
}

$p = new Producto("Pared","Agua");
function getProductPrice(ProductFactory $factory): string
{   
    return 'hola';
}



echo "\n";

$req = json_decode(file_get_contents("php://input"), true);
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
      echo('todo oki');
        
        break;
    case "POST":
        $result = new Producto($req["area_aplicacion"],$req["base_pintura"]);
      
        if($req["descripcion"] == "Tinte"){
            $req["precio"]  =($result->getProductPrice(new FactoryTinte()));
        }else{
            $req["precio"] =  ($result->getProductPrice(new FactoryPintura()));
            
        }
        $futureDate=date('Y-m-d', strtotime('+1 year'));

        $req["fecha_caducidad"] = $futureDate;
        $req["cantidad_stock"] = 0;
        $req["marca"]= 'Lanco';
        $req["max"]= 0;
        $req["min"]= 0;
        
        $result = $producto->insertar($req);
        break;
    case "PUT":
        break;
    case "DELETE":
        break;
}
