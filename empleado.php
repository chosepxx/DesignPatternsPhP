<?php
include 'db.php';
class empleado extends db
{

    function listar()
    {
        $query = $this->conectar()->query('SELECT * FROM empleado');
        $result = array();

        if ($query->rowcount()) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    "id_empleado" => $row["id_empleado"],
                    "nombre" => $row["nombre"],
                    "apellidos" => $row["apellidos"]

                );


                array_push($result, $item);
            }
        }

        //echo ($result);
        return $result;
    }
}
