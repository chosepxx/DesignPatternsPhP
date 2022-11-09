<?php
include 'db.php';
class producto extends db
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



    function buscar_por_id($id_producto)
    {
        $query = $this->conectar()->query('SELECT * FROM registro_pintura WHERE id_registro=id_registro');
        $result = array();

        if ($query->rowcount()) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = array(

                    "fecha_compra" => $row["fecha_compra"],
                    "id_cliente" => $row["id_cliente"],
                    "id_empleado" => $row["id_empleado"],
                    "id_producto" => $row["id_producto"],
                    "base" => $row["base"],
                    "acabado" => $row["acabado"],
                    "formula_color" => $row["formula_color"],
                    "tamano_envase" => $row["tamano_envase"]

                );
                array_push($result, $item);
            }
        }
        echo count($result);
        return $result;
    }


    function eliminar($id_producto)
    {
        $query = "DELETE FROM productos where id_producto = :id_producto";

        $stmt = $this->conectar()->prepare($query);
        echo $id_producto;
        $stmt->bindParam(':id_producto', $id_producto);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r("Error: %s \n", $stmt->error);
            return false;
        }
    }
}
