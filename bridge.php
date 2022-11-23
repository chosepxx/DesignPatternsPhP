<?php
namespace bridgeSH;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT,OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

class Pintura
{
    protected $tipoDePintura;
    public $base;

    public $descripcion;

   public function __construct(TipoPintura $tipoDePintura, $descripcion)
    {
        $this->tipoDePintura = $tipoDePintura;
        $this->descripcion = $descripcion;
    }




public function tipoDepintura(): int
    { 
            $this->tipoDePintura->tipo(0, 0);
            return 0;
    }
}


class Techos extends Pintura
{
    public function __construct(TipoPintura $tipoPintura, $descripcion)
    {
      parent::__construct($tipoPintura, $descripcion);
       
    }

    public function tipoDepintura(): int
    {
     $result=0;
     $result= $this->tipoDePintura->tipo(5000, 5000);
     return $result;
    }


}

class Pared extends Pintura
{

    public function __construct(TipoPintura $tipoPintura, $descripcion)
    {
      parent::__construct($tipoPintura,$descripcion);
       
    }

    public function tipoDepintura(): int
    {
        $result=0;
        $result= $this->tipoDePintura->tipo(8000, 5000);
        return $result;
    }


}

interface TipoPintura{

    public function tipo(int $precioBase, int $precioArea): int;
}

class Aceite implements TipoPintura
{
    public function tipo(int $precioBase, int $precioArea): int
    {
        return 1.5*($precioBase+$precioArea);
    }
}

class Agua implements TipoPintura
{

    public function tipo(int $precioBase, int $precioArea): int
    {
        return 1*($precioBase+$precioArea);
    }
}


use productoServices;
require_once 'vendor/autoload.php';
$producto = new productoServices();
$req = json_decode(file_get_contents("php://input"), true);
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        $implementation = new Agua();
   
        echo $abstraction->tipoDepintura();
        echo $abstraction->base;
        echo $abstraction->tipoDepintura();

        break;
    case "POST":
        $implementation = NULL;
        $abstraction = NULL;

        if($req["base_pintura"] == "Agua"){
            $implementation = new Agua();
        }else{
            $implementation = new Aceite();
        }

        if($req["area_aplicacion"] == "Pared"){
            $abstraction = new Pared($implementation, "Pintura");
        }else{
            $abstraction = new Techos($implementation, "Pintura");
        }

        $req["descripcion"] = "Pintura";

        $req["precio"] =  $abstraction->tipoDepintura();;
        $futureDate=date('Y-m-d', strtotime('+1 year'));
        $req["fecha_caducidad"] = $futureDate;
        $req["cantidad_stock"] = 20;
        $req["marca"]= 'Lanco';
        $req["max"]= 50;
        $req["min"]= 10;

        $result = $producto->insertar($req);
        break;
}