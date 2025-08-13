<?php

// El álias que tendrá para encontrarlo fácilmente
namespace App\Models;

// Se llama a la conexión de la base de datos
use Config\Database;

class ActivosAM {
    private $conn;

    public function __construct() {
        $database = new \Config\Database();
        $this->conn = $database->getConnection();
    }

    public function findActivoforNaturaleza(int $naturaleza): ?array {
        $sql = "SELECT
                c.naturaleza, c.submodelo, c.modificado_el, tipo_pc"
    } 
}

?>