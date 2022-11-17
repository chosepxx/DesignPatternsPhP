<?php declare(strict_types=1);


/* ./vendor/bin/phpunit tests

./vendor/bin/phpunit --testdox tests  */
require 'vendor/autoload.php';
final class BaseDeDatosTest extends PHPUnit\Framework\TestCase
{


 
    public function testConexionBaseDeDatos(): void
    {
        $database = new db();
        $this->assertTrue($database->conectarTest());
    }
 


}
