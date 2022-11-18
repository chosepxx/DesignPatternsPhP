<?php declare(strict_types=1);


include_once("productoServices.php");

$producto = new productoServices();

/* ./vendor/bin/phpunit tests

./vendor/bin/phpunit --testdox tests  */

final class ProductTest extends PHPUnit\Framework\TestCase
{
 
    public function testAgregarProducto(): void
    {
       $datos = array(
            "area_aplicacion"=> "PruebaNueva",
            "descripcion"=> "Unitaria",
            "base_pintura"=> "Acrilica",
            "color_pintura"=> "Azul",
            "precio"=> 15000,
            "fecha_caducidad"=> "2022-10-10",
            "cantidad_stock"=> 50,
            "marca"=> "Test",
            "max"=> 100,
            "min"=>10
        );
     
        $GLOBALS['producto']->insertar( $datos);
        $last = $GLOBALS['producto']->getLastProduct();
        
      
        $this->assertEquals(
            $datos,
            $last
        );
    }

 

    public function testEditarProducto(): void
    {
        $last = $GLOBALS['producto']->getLastProductWithId();
        $last["base_pintura"] = "base editada";
        $this->assertTrue( $GLOBALS['producto']->actualizar( $last));
    }


    public function testEliminarProducto(): void
{
   

    $last = $GLOBALS['producto']->getLastProductWithId();
 
    $this->assertTrue( $GLOBALS['producto']->eliminar( $last["id_producto"]));
 
}


}
