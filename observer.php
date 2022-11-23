<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT,OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
abstract class AbstractObserver {
    abstract function update(AbstractSubject $subject_in);
}

abstract class AbstractSubject {
    abstract function attach(AbstractObserver $observer_in);
    abstract function detach(AbstractObserver $observer_in);
    abstract function notify();
}

function writeln($line_in) {
    echo $line_in."<br/>";
}

class PatternObserver extends AbstractObserver {
    public function __construct() {
    }
    public function update(AbstractSubject $subject) {
        

        if($subject->getStock() < 10){
        //email
            
            $data = "El stock de " . $subject->getDatos()["descripcion"] .   " de color " . $subject->getDatos()["color_pintura"] . " con id = " . $subject->getDatos()["id_producto"] . " ha bajado del min";
            $producto = new productoServices();
            $producto->insertarHistorial($data);
            echo('email');

        }
    }
}

class PinturaStock extends AbstractSubject {
    private $stock = NULL;
    private $observers = array();
    private $datos = NULL;
    function __construct($datos) {
        $this->datos = $datos;
    }

    function attach(AbstractObserver $observer_in) {
      $this->observers[] = $observer_in;
    }
    function detach(AbstractObserver $observer_in) {
      foreach($this->observers as $okey => $oval) {
        if ($oval == $observer_in) { 
          unset($this->observers[$okey]);
        }
      }
    }
    function notify() {
      foreach($this->observers as $obs) {
        $obs->update($this);
      }
    }
    function updateStock($newStock) {
      $this->stock = $newStock;
      $this->notify();
    }
    function getStock() {
      return $this->stock;
    }
    function getDatos() {
        return $this->datos;
      }
}

require_once 'vendor/autoload.php';

$req = json_decode(file_get_contents("php://input"), true);
$producto = new productoServices();
$json = array();
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        $result = $producto->listar_historial();
        echo json_encode($result);
     break;

}





?>