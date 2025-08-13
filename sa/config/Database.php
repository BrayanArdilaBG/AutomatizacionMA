<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'activos_am';
    private $username = 'root';
    private $password = '';
    public $conn = null;

    public function getConnection() {
        // Si ya tenemos una conexión, la reutilizamos para ser eficientes
        if ($this->conn) {
            return $this->conn;
        }

        // Desactivamos los reportes de error de PHP para manejarlos nosotros
        mysqli_report(MYSQLI_REPORT_OFF);

        // Intentamos crear la conexión
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Verificamos si hubo un error en la conexión
        if ($this->conn->connect_error) {
            // Si hay un error, detenemos todo y mostramos un mensaje claro
            die("<h1>Error Crítico de Base de Datos</h1><p>No se pudo conectar a MySQL.</p><p><strong>Error exacto:</strong> " . $this->conn->connect_error . "</p>");
        }
        
        // Si el código llega hasta aquí, la conexión fue exitosa.
        // Establecemos el charset a UTF-8 para evitar problemas con tildes y caracteres especiales
        $this->conn->set_charset('utf8');
        
        // Devolvemos el objeto de conexión para que otros archivos puedan usarlo
        return $this->conn;
    }
}
?>