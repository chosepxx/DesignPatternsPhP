<?php
require_once 'vendor/autoload.php';
interface SQLQueryBuilder
{
    public function select(string $table, array $fields): SQLQueryBuilder;

    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder;

    public function getSQL(): string;
}

class MysqlQueryBuilder implements SQLQueryBuilder
{
    protected $query;

    protected function reset(): void
    {
        $this->query = new \stdClass();
    }

  
    public function select(string $table, array $fields): SQLQueryBuilder
    {
        $this->reset();
        $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        $this->query->type = 'select';

        return $this;
    }

    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new \Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
        }
        $this->query->where[] = "$field $operator '$value'";

        return $this;
    }

 
    public function limit(int $start, int $offset): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }
        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

  
    public function getSQL(): string
    {
        $query = $this->query;
        $sql = $query->base;
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        $sql .= ";";
        return $sql;
    }
}


function buscar_por_id($queryData)
{
    $db = new db();
    $query = $db->conectar()->query($queryData);
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





$req = json_decode(file_get_contents("php://input"), true);

$json = array();
switch ($_SERVER['REQUEST_METHOD']) { 
    case "GET":
        $queryBuilder = new MysqlQueryBuilder();
        $query = $queryBuilder
        ->select("productos", [ "*"])
        ->where("id_producto",  $req["id_producto"]  , "=")
        ->getSQL();
        $result = buscar_por_id($query);
        echo json_encode($result);
        
    break;

}
