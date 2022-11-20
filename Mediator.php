<?php

namespace MediatorPattern;
use productoServices;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT,OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
include('../productoServices.php');

$MARCA;
$FECHA;
interface Mediator
{
    public function notify(object $sender, string $event): void;
}

class MediatorPintura implements Mediator
{
    private $component1;

    private $component2;

    public function __construct(Pinturas $c1, Atributos $c2)
    {
        $this->component1 = $c1;
        $this->component1->setMediator($this);
        $this->component2 = $c2;
        $this->component2->setMediator($this);
    }

    public function notify(object $sender, string $event): void
    {
        if ($event == "Acrilica") {
          //  echo "Mediator reacts on Acrilica and triggers following operations:\n";
            $this->component2->setMarca('Vinci');
            $this->component2->fiveYear();
        }

        if ($event == "Aceite") {
           // echo "Mediator reacts on Aceite and triggers following operations:\n";
            $this->component2->setMarca('Lanco');
            $this->component2->fiveYear();

        }
        if ($event == "Agua") {
           // echo "Mediator reacts on Agua and triggers following operations:\n";
            $this->component2->setMarca('Lanco');
            $this->component2->twoYears();
      
        }

    }
}


class Productos
{
    protected $mediator;

    public function __construct(Mediator $mediator = null)
    {
        $this->mediator = $mediator;
    }

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
}


class Pinturas extends Productos
{
    public function CreateAcrilica(): void
    {
        $this->mediator->notify($this, "Acrilica");
    }

    public function CreateAgua(): void
    {
     
        $this->mediator->notify($this, "Agua");
    }

    public function createAceite(): void
    {

        $this->mediator->notify($this, "Aceite");
    }


}

class Atributos extends Productos
{   
    
    public function setMarca($marca): void
    {
  
        $this->mediator->notify($this, $marca);
         $GLOBALS['MARCA'] = $marca;
    }
    public function twoYears(): void
    {
        $futureDate=date('Y-m-d', strtotime('+2 year'));
        $GLOBALS['FECHA'] = $futureDate;
        $this->mediator->notify($this, "2anos");
    }

    public function fiveYear(): void
    {
        $futureDate=date('Y-m-d', strtotime('+5 year'));
        $GLOBALS['FECHA'] = $futureDate;
        $this->mediator->notify($this, "5anos");
    }


}


$producto = new productoServices();
$req = json_decode(file_get_contents("php://input"), true);
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
      echo('todo oki');
        
        break;
    case "POST":
        
    
        $c1 = new Pinturas();
        $c2 = new Atributos();
        $mediator = new MediatorPintura($c1, $c2);

     
      
        if($req["base_pintura"] == "Acrilica"){
            $c1->CreateAcrilica();

        }else if($req["base_pintura"] == "Agua"){
            
            $c1->CreateAgua();
          
        }else{
            $c1->createAceite();
        }
    

        $req["fecha_caducidad"] = $GLOBALS['FECHA'];
        $req["cantidad_stock"] = 0;
        $req["marca"]=  $GLOBALS['MARCA'];
        $req["max"]= 0;
        $req["min"]= 0;
        
        $result = $producto->insertar($req);
        break;
    case "PUT":
        break;
    case "DELETE":
        break;
}
