<?php
require 'vendor/autoload.php';
class productoServices extends db
{

    function listar_productos()
    {
        $query = $this->conectar()->query('SELECT * FROM productos');
        $result = array();

        if ($query->rowcount()) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    "id_producto" => $row["id_producto"],
                    "base_pintura" => $row["base_pintura"],
                    "precio" => $row["precio"],
                    "area_aplicacion" => $row["area_aplicacion"],
                    "fecha_caducidad" => $row["fecha_caducidad"],
                    "color_pintura" => $row["color_pintura"],
                    "cantidad_stock" => $row["cantidad_stock"],
                    "max" => $row["max"],
                    "min" => $row["min"],
                    "descripcion" => $row["descripcion"],
                    "marca" => $row["marca"]

                );


                array_push($result, $item);
            }
        }

        //echo ($result);
        return $result;
    }

    function listar_productosPremium()
    {
        $query = $this->conectar()->query('SELECT * FROM productos Where premium = 1');
        $result = array();

        if ($query->rowcount()) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    "id_producto" => $row["id_producto"],
                    "base_pintura" => $row["base_pintura"],
                    "precio" => $row["precio"],
                    "area_aplicacion" => $row["area_aplicacion"],
                    "fecha_caducidad" => $row["fecha_caducidad"],
                    "color_pintura" => $row["color_pintura"],
                    "cantidad_stock" => $row["cantidad_stock"],
                    "max" => $row["max"],
                    "min" => $row["min"],
                    "descripcion" => $row["descripcion"],
                    "marca" => $row["marca"]

                );


                array_push($result, $item);
            }
        }

        //echo ($result);
        return $result;
    }


    function addPremium($id_producto)
    {
        $query = "UPDATE productos SET premium = '1' where id_producto = :id_producto;";

        $stmt = $this->conectar()->prepare($query);
    
        $stmt->bindParam(':id_producto', $id_producto);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r("Error: %s \n", $stmt->error);
            return false;
        }
    }
    function rmPremium($id_producto)
    {
        $query = "UPDATE productos SET premium = '0' where id_producto = :id_producto;";

        $stmt = $this->conectar()->prepare($query);
    
        $stmt->bindParam(':id_producto', $id_producto);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r("Error: %s \n", $stmt->error);
            return false;
        }
    }
    function insertar($req)
    {
    

        $precio = $req["precio"];  
        $base_pintura = $req["base_pintura"];
        $area_aplicacion = $req["area_aplicacion"];
        $fecha_caducidad = $req["fecha_caducidad"];
        $color_pintura = $req["color_pintura"];
        $cantidad_stock = $req["cantidad_stock"];
        $descripcion = $req["descripcion"];
        $marca = $req["marca"];
        $max = $req["max"];
        $min = $req["min"];

        $query = "INSERT INTO productos SET 
        base_pintura=:base_pintura, precio=:precio,
        area_aplicacion=:area_aplicacion, fecha_caducidad=:fecha_caducidad, color_pintura=:color_pintura,
        cantidad_stock=:cantidad_stock, descripcion=:descripcion,marca=:marca,max=:max,min=:min";



        $stmt = $this->conectar()->prepare($query);


        $stmt->bindParam(':base_pintura',   $base_pintura);
        $stmt->bindParam(':precio',      $precio);
        $stmt->bindParam(':area_aplicacion',     $area_aplicacion);
        $stmt->bindParam(':fecha_caducidad',   $fecha_caducidad);
        $stmt->bindParam(':color_pintura',   $color_pintura);
        $stmt->bindParam(':cantidad_stock',      $cantidad_stock);
        $stmt->bindParam(':descripcion',     $descripcion);
        $stmt->bindParam(':marca',     $marca);
        $stmt->bindParam(':max',     $max);
        $stmt->bindParam(':min',     $min);


        if ($stmt->execute()) {
            return true;
        } else {
            print_r("Error: %s \n", $stmt->error);
            return false;
        }
    }


    function getLastProduct()
    {
        $query = $this->conectar()->query('SELECT * FROM productos ORDER BY id_producto DESC LIMIT 1');
        $item = array();
        if ($query->rowcount()) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $item = array(
                "base_pintura" => $row["base_pintura"],
                "precio" => $row["precio"],
                "area_aplicacion" => $row["area_aplicacion"],
                "fecha_caducidad" => $row["fecha_caducidad"],
                "color_pintura" => $row["color_pintura"],
                "cantidad_stock" => $row["cantidad_stock"],
                "max" => $row["max"],
                "min" => $row["min"],
                "descripcion" => $row["descripcion"],
                "marca" => $row["marca"]
            );
        }

        return $item;
    }
    
    function getLastProductWithId()
    {
        $query = $this->conectar()->query('SELECT * FROM productos ORDER BY id_producto DESC LIMIT 1');
        $item = array();
        if ($query->rowcount()) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $item = array(
                "id_producto"=> $row["id_producto"],
                "base_pintura" => $row["base_pintura"],
                "precio" => $row["precio"],
                "area_aplicacion" => $row["area_aplicacion"],
                "fecha_caducidad" => $row["fecha_caducidad"],
                "color_pintura" => $row["color_pintura"],
                "cantidad_stock" => $row["cantidad_stock"],
                "max" => $row["max"],
                "min" => $row["min"],
                "descripcion" => $row["descripcion"],
                "marca" => $row["marca"]
            );
        }

        return $item;
    }

    function buscar_por_id($id_producto)
    {
        $query = $this->conectar()->query("SELECT * FROM productos where id_producto = '" . $id_producto . "' ");
        $item = array();
        if ($query->rowcount()) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $item = array(
                "id_producto" => $row["id_producto"],
                "base_pintura" => $row["base_pintura"],
                "precio" => $row["precio"],
                "area_aplicacion" => $row["area_aplicacion"],
                "fecha_caducidad" => $row["fecha_caducidad"],
                "color_pintura" => $row["color_pintura"],
                "cantidad_stock" => $row["cantidad_stock"],
                "max" => $row["max"],
                "min" => $row["min"],
                "descripcion" => $row["descripcion"],
                "marca" => $row["marca"]
            );
        }

        return $item;
    }


    function eliminar($id_producto)
    {
        $query = "DELETE FROM productos where id_producto = :id_producto";

        $stmt = $this->conectar()->prepare($query);
    
        $stmt->bindParam(':id_producto', $id_producto);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r("Error: %s \n", $stmt->error);
            return false;
        }
    }


    function actualizar($req)
    {
        $id_producto = $req["id_producto"];
        $base_pintura = $req["base_pintura"];
        $precio = $req["precio"];
        $area_aplicacion = $req["area_aplicacion"];
        $fecha_caducidad = $req["fecha_caducidad"];
        $color_pintura = $req["color_pintura"];
        $cantidad_stock = $req["cantidad_stock"];
        $descripcion = $req["descripcion"];
        $marca = $req["marca"];
        $max = $req["max"];
        $min = $req["min"];




        $query = "UPDATE productos SET 
        base_pintura=:base_pintura, precio=:precio,
        area_aplicacion=:area_aplicacion, fecha_caducidad=:fecha_caducidad, color_pintura=:color_pintura,
        cantidad_stock=:cantidad_stock, descripcion=:descripcion,marca=:marca,max=:max,min=:min  WHERE id_producto = :id_producto ";

        $stmt = $this->conectar()->prepare($query);
        $stmt->bindParam(':id_producto',     $id_producto);
        $stmt->bindParam(':base_pintura',   $base_pintura);
        $stmt->bindParam(':precio',      $precio);
        $stmt->bindParam(':area_aplicacion',     $area_aplicacion);
        $stmt->bindParam(':fecha_caducidad',   $fecha_caducidad);
        $stmt->bindParam(':color_pintura',   $color_pintura);
        $stmt->bindParam(':cantidad_stock',      $cantidad_stock);
        $stmt->bindParam(':descripcion',     $descripcion);
        $stmt->bindParam(':marca',     $marca);
        $stmt->bindParam(':max',     $max);
        $stmt->bindParam(':min',     $min);




        if ($stmt->execute()) {
            return true;
        } else {
            print_r("Error: %s \n", $stmt->error);
            return false;
        }
    }
}
