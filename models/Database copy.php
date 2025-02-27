<?php 
// /models/Database.php
namespace App; // xcomposer in App namespace i altında çalışabilmesi için

// /models/Database.php
class Database {
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $port;
    private $conn;
    private $stmt;
    private static $instance = null;

    private function __construct() {
        $this->initializeDbSettings();
        $this->connect();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function initializeDbSettings() {
        // GlobalVars sınıfını kullanarak DB ayarlarını alıyoruz
        $this->host =getenv('DB_HOST');
        $this->user =  getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
        $this->dbname = getenv('DB_NAME');
        $this->port =getenv('DB_PORT');
    }

    private function connect() {
        $this->conn = new \mysqli($this->host, $this->user, $this->pass, $this->dbname, $this->port);

        if ($this->conn->connect_error) {
            die("Bağlantı hatası: " . $this->conn->connect_error);
        }

        // UTF-8 desteği
        $this->conn->set_charset(GlobalVars::get('db')->charset);
    }

    public function query($sql, $params = []) {
        $this->stmt = $this->conn->prepare($sql);
        if (!$this->stmt) {
            die("Sorgu hatası: " . $this->conn->error);
        }

        if (!empty($params)) {
            $types = str_repeat("s", count($params)); // Tüm parametreler string olarak bağlanıyor
            $this->stmt->bind_param($types, ...$params);
        }

        $this->stmt->execute();
        return $this->stmt;
    }

    public function select($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($sql, $params = []) {
        $this->query($sql, $params);
        return $this->conn->insert_id;
    }

    public function update($sql, $params = []) {
        $this->query($sql, $params);
        return $this->stmt->affected_rows;
    }

    public function delete($sql, $params = []) {
        return $this->update($sql, $params);
    }

    public function close() {
        if ($this->stmt) {
            $this->stmt->close();
        }
        $this->conn->close();
    }

    private function __clone() {}
    public function __wakeup(){
        throw new Exception("Cannot unserialize a singleton.");
    }
}
