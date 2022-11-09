<?php
include("productoServices.php");

class fusionarTabla{


function registro($registro){
    $producto = new productoServices();
    $result = "API PHP";
    
//$result = $producto->listar_productos();

$tamanio = count($registro);
for ($x=0;$x<$tamanio; $x++)
  echo $registro[$x]."<br>";




}

}

?>