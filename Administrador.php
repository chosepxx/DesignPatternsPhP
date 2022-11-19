<?php
require_once 'patrones/observer/observer.php';
//include("registro_pinturaServices.php");

class Administrador implements observer{

  public  $cod_registro ;
  public $cod_admin;

  public function __construct($cod_registro, $cod_admin)
  {
     $this->cod_registro = $cod_registro;  
     $this->cod_admin = $cod_admin; 
  }   

function update ($cod_registro, $cod_admin){

   // $registro_ob = new registro_pinturaServices();

 //   $registro_ob->agregarRegistroObserver($cod_registro, $cod_admin);

}


}



?>
