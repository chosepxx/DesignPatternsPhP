<?php
include 'db.php';
class cliente extends db
{

    function listar()
    {
        $query = $this->conectar()->query('SELECT * FROM cliente');
        $result = array();

        if ($query->rowcount()) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    "id_cliente" => $row["id_cliente"],
                    "nombre" => $row["nombre"],
                    "apellidos" => $row["apellidos"]
                    
                );
                array_push($result, $item);
            }
        }

        return $result;
    }
}
