<?php 
include 'db.php';
include 'registro_pinturaO.php';

class registro_pinturaServices extends db{

    function listar(){ 
        $query = $this->conectar()->query('SELECT * FROM registro_pintura');
        $registro = new registro_pinturaO();
        $result = array();
      //  $myArray[] = $registro;
    

        if($query->rowcount()){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = array(
                    "id_registro" => $row["id_registro"],
                    "fecha_compra" => $row["fecha_compra"],
                    "id_cliente" => $row["id_cliente"],
                    "id_empleado" => $row["id_empleado"],
                    "id_producto" => $row["id_producto"],
                    "base" => $row["base"],
                    "acabado" => $row["acabado"],
                    "formula_color" => $row["formula_color"],
                    "tamano_envase" => $row["tamano_envase"],
                    "nombre_cliente" => "",
                    "nombre_empleado" => "",
                    "nombre_producto"=>""

                );
                array_push($result,$item);
            }

    
        }
      //  echo count($result);
        return $result;
    }

//me hace falta

    function buscar_por_id($id_registro){ 
        $query = $this->conectar()->query("SELECT * FROM registro_pintura where id_registro = '" . $id_registro . "' ");
        $result = array();

        if($query->rowcount()){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = array(
                    "id_registro" => $row["id_registro"],
                    "fecha_compra" => $row["fecha_compra"],
                    "id_cliente" => $row["id_cliente"],
                    "id_empleado" => $row["id_empleado"],
                    "id_producto" => $row["id_producto"],
                    "base" => $row["base"],
                    "acabado" => $row["acabado"],
                    "formula_color" => $row["formula_color"],
                    "tamano_envase" => $row["tamano_envase"],
                    "nombre_cliente" => "",
                    "nombre_empleado" => "",
                    "nombre_producto"=>""
    
                );
                array_push($result,$item);
            }

    
        }
     
        return $result;
    }



           function insertar($req){

            $fecha_compra = $req["fecha_compra"];
            $id_cliente = $req["id_cliente"];
            $id_empleado = $req["id_empleado"];
            $id_producto = $req["id_producto"];
            $base = $req["base"];
            $acabado = $req["acabado"];
            $formula_color = $req["formula_color"];
            $tamano_envase = $req["tamano_envase"];

            $query = "INSERT INTO registro_pintura SET
            fecha_compra=:fecha_compra, 
            id_cliente=:id_cliente, id_empleado=:id_empleado,
            id_producto=:id_producto, base=:base, acabado=:acabado,
            formula_color=:formula_color, tamano_envase=:tamano_envase";



            $stmt = $this->conectar()->prepare($query);

            $stmt->bindParam(':fecha_compra',   $fecha_compra);
            $stmt->bindParam(':id_cliente',   $id_cliente);
            $stmt->bindParam(':id_empleado',      $id_empleado);
            $stmt->bindParam(':id_producto',     $id_producto);
            $stmt->bindParam(':base',   $base);
            $stmt->bindParam(':acabado',   $acabado);
            $stmt->bindParam(':formula_color',      $formula_color);
            $stmt->bindParam(':tamano_envase',     $tamano_envase);
            

            if($stmt->execute()){
                return true;
            }else{
                print_r("Error: %s \n",$stmt->error);
                return false;
            }
     

        }


        function actualizar($req){

            $id_registro = $req["id_registro"];
            $fecha_compra = $req["fecha_compra"];
            $id_cliente = $req["id_cliente"];
            $id_empleado = $req["id_empleado"];
            $id_producto = $req["id_producto"];
            $base = $req["base"];
            $acabado = $req["acabado"];
            $formula_color = $req["formula_color"];
            $tamano_envase = $req["tamano_envase"];

            $query = "UPDATE registro_pintura SET
            fecha_compra=:fecha_compra, 
            id_cliente=:id_cliente, id_empleado=:id_empleado,
            id_producto=:id_producto, base=:base, acabado=:acabado,
            formula_color=:formula_color, tamano_envase=:tamano_envase
            WHERE id_registro = :id_registro";



            $stmt = $this->conectar()->prepare($query);
            $stmt->bindParam(':id_registro',   $id_registro);
            $stmt->bindParam(':fecha_compra',   $fecha_compra);
            $stmt->bindParam(':id_cliente',   $id_cliente);
            $stmt->bindParam(':id_empleado',      $id_empleado);
            $stmt->bindParam(':id_producto',     $id_producto);
            $stmt->bindParam(':base',   $base);
            $stmt->bindParam(':acabado',   $acabado);
            $stmt->bindParam(':formula_color',      $formula_color);
            $stmt->bindParam(':tamano_envase',     $tamano_envase);
            

            if($stmt->execute()){
                return true;
            }else{
                print_r("Error: %s \n",$stmt->error);
                return false;
            }

        }

        function eliminar($id_registro){
            $query = "DELETE FROM registro_pintura where id_registro = :id_registro";

            $stmt = $this->conectar()->prepare($query);
            echo $id_registro;
            $stmt->bindParam(':id_registro', $id_registro);

            if($stmt->execute()){
                return true;
            }else{
                print_r("Error: %s \n",$stmt->error);
                return false;
            }
        }



}
