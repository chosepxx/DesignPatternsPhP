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
}
