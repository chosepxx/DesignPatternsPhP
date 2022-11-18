<?php

class db
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;


    public function __construct()
    {
        $this->host = "localhost";
        $this->db = "empresa_lanco";
        $this->user = "root";
        $this->password = "";
        $this->charset = "utf8mb4";
    }

    public function conectar()
    {
        try {

            $conexion = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => FALSE
            ];

            $pdo = new PDO($conexion, $this->user, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) {
            print_r("Error" . $e->getMessage());
        }
    }

    public function conectarTest(){
        $conn = new mysqli($this->host, $this->user, $this->password ,$this->db ) or die("Connect failed: %s\n". $conn -> error);
        return true;
    }
   
    
}
