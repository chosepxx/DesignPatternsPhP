<?php
require 'vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT,OPTIONS,DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
abstract class Producto { 
    // leaf classes do not have add() function
    public function add(Producto $producto)
    {
    	return;
    } 

    // leaf classes do not have remove() function
    public function remove(Producto $producto)
    {
    	return;
    } 

    public function getPremiums()   {
    	return;
    } 
    
    abstract function getData(); 
}

class Pintura extends Producto
{
	private $product ;
	private  $unit = [];

    function __construct() {
        $this->product = new productoServices();
        $this->unit  =  $this->product->listar_productosPremium();
    }
	public function add(Producto $unit)
	{
		if (!in_array($unit, $this->unit, true)) {
			$this->unit[] = $unit->getData();	
		}
	}


	public function remove($unit)
	{
        $this->product->rmPremium($unit);
	
	}


	public function getData() {
        return $this->unit;
	}
}

class Premium extends Producto
{
    private $id;
    function __construct($id) {
        $this->id = $id;
        $product = new productoServices();
        $product->addPremium($id);
    }
	public function getData()
	{
        $product = new productoServices();
        return  $product->buscar_por_id($this->id);
    }

    public function removePrem()
	{
        $product = new productoServices();
        return  $product->rmPremium($this->id);
    }
		
		   
}
 
 
$product = new Pintura();
$json = array();




$req = json_decode(file_get_contents("php://input"), true);
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        
         
        echo json_encode($product->getData());
        break;
    case "POST":
        $p1 = new Premium($req["id_producto"]);
        $product->add($p1);
        break;
    case "PUT":
        break;
    case "DELETE":
        $product->remove($req["id_producto"]);
        break;
}

//echo json_encode($product->getPremiums());