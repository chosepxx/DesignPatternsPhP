<?php declare(strict_types=1);



$registro = new registro_pinturaServices();

/* ./vendor/bin/phpunit tests

./vendor/bin/phpunit --testdox tests  */

final class RegistroPinturaTest extends PHPUnit\Framework\TestCase
{

 

    public function testAgregarRegistro(): void
    {
       $datos = array(
        "fecha_compra" => "2022-10-10",
        "id_cliente" => 1,
        "id_empleado" => 1,
        "id_producto" => 27,
        "base" => "Test",
        "acabado" => "Test",
        "formula_color" => "Test123",
        "tamano_envase" => "Test"
    );
     
        $GLOBALS['registro']->insertar( $datos);
        $last = $GLOBALS['registro']->getLastRegistro();
        
      
        $this->assertEquals(
            $datos,
            $last
        );
    }

 

    public function testEditarRegistro(): void
    {
        $last = $GLOBALS['registro']->getLastRegistroWithId();
        $last["base"] = "base editada";
        $this->assertTrue( $GLOBALS['registro']->actualizar( $last));
    }


    public function testEliminarRegistro(): void
{
   

    $last = $GLOBALS['registro']->getLastRegistroWithId();
 
    $this->assertTrue( $GLOBALS['registro']->eliminar( $last["id_registro"]));
 
}




}
