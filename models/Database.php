<?php
// /models/Database.php
namespace App; // Composer'ın App namespace'i altında çalışabilmesi için

class Database {
    private string $host;
    private string $user;
    private string $pass;
    private string $dbname;
    private int $port;
    private string $charset;
    private \mysqli $conn;
    private ?\mysqli_stmt $stmt = null;
    private static ?self $instance = null;

    private function __construct() {
        $this->initializeDbSettings();
        $this->connect();
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function initializeDbSettings(): void {
        // Vars sınıfını kullanarak DB ayarlarını alıyoruz
        $config = Vars::get('db');
        $this->host = $config->host;
        $this->user = $config->user;
        $this->pass = $config->password;
        $this->dbname = $config->name;
        $this->port = (int) $config->port;
        $this->charset = $config->charset;
    }

    private function connect(): void {
        $this->conn = new \mysqli($this->host, $this->user, $this->pass, $this->dbname, $this->port);

        if ($this->conn->connect_error) {
            die("Bağlantı hatası: " . $this->conn->connect_error);
        }

        // UTF-8 desteği
        $this->conn->set_charset($this->charset);
    }

    public function query(string $sql, array $params = []): ?\mysqli_stmt {
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

    public function select(string $sql, array $params = []): array {
        $stmt = $this->query($sql, $params);
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert(string $sql, array $params = []): int {
        $this->query($sql, $params);
        return $this->conn->insert_id;
    }

    public function update(string $sql, array $params = []): int {
        $this->query($sql, $params);
        return $this->stmt->affected_rows;
    }

    public function delete(string $sql, array $params = []): int {
        return $this->update($sql, $params);
    }

    public function close(): void {
        if ($this->stmt) {
            $this->stmt->close();
        }
        $this->conn->close();
    }

    private function __clone() {}
    
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}
