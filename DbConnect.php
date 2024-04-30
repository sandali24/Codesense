<?php
class DbConnect {
    // Private properties to store database connection details
    private $host = 'localhost';
    private $dbName = 'selectiontest';
    private $user = 'root';
    private $pass = 'Sandali24&$';

    public function connect() {
        try {
            // Create a new PDO object to establish a connection to the database
            $conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }
}
?> 