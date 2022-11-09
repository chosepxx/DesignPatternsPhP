<?php
class registro_pinturaO
{
    private $fecha_compra;
    private $id_cliente;
    private $id_registro;
    private $id_empleado;
    private $id_producto;
    private $base;
    private $acabado;
    private $formula_color;
    private $tamano_envase;
    private $nombre_cliente;
    private $nombre_registro;
    private $nombre_empleado;
    private $nombre_producto;

    public function getFecha_compra()
    {
        return $this->fecha_compra;
    }
 
    public function setFecha_compra($fecha_compra)
    {
        $this->fecha_compra = $fecha_compra;
    }

    public function getId_cliente()
    {
        return $this->id_cliente;
    }
 
    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getId_registro()
    {
        return $this->id_registro;
    }
 
    public function setId_registro($id_registro)
    {
        $this->id_registro = $id_registro;
    }

    public function getId_empleado()
    {
        return $this->id_empleado;
    }
 
    public function setId_empleado($id_empleado)
    {
        $this->id_empleado = $id_empleado;
    }
}
?>