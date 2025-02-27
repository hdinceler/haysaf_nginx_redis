<?php
// /models/Security.php:
namespace App; // xcomposer in App namespace i altında çalışabilmesi için

require_once __DIR__ . '/Database.php';

class Security {
    private static ?Security $instance = null;
    private static ?Database $db = null;

    private function __construct() {
        self::$db = Database::getInstance();
    }

    public static function getInstance(): Security {
        if (self::$instance === null) {
            self::$instance = new Security();
        }
        return self::$instance;
    }

    // Genel temizleme fonksiyonu (SQL Injection + XSS için)
    public static function sanitize($data): string {
        if (is_array($data)) {
            return array_map([self::class, 'sanitize'], $data);
        }
        $data = trim($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return self::$db ? self::$db->select("SELECT ?", [$data])[0]['?'] ?? $data : $data;
    }

    // Güvenli POST verisi al
    public static function securePost($key): ?string {
        return isset($_POST[$key]) ? self::sanitize($_POST[$key]) : null;
    }

    // Güvenli GET verisi al
    public static function secureGet($key): ?string {
        return isset($_GET[$key]) ? self::sanitize($_GET[$key]) : null;
    }

    // Güvenli REQUEST verisi al
    public static function secureRequest($key): ?string {
        return isset($_REQUEST[$key]) ? self::sanitize($_REQUEST[$key]) : null;
    }

    // Güvenli COOKIE verisi al
    public static function secureCookie($key): ?string {
        return isset($_COOKIE[$key]) ? self::sanitize($_COOKIE[$key]) : null;
    }

    // CSRF Token oluştur
    public static function generateCsrfToken(): string {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // CSRF Token doğrula
    public static function verifyCsrfToken($token): bool {
        if (!isset($_SESSION)) session_start();
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    // IP doğrulama
    public static function getClientIP(): string {
        return $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    }

    // User-Agent kontrolü
    public static function getUserAgent(): string {
        return $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';
    }

    // Güvenli oturum başlatma
    public static function startSecureSession(): void {
        if (!isset($_SESSION)) {
            session_start();
            session_regenerate_id(true);
        }
    }

    // JSON verisini güvenli şekilde al
    public static function secureJsonInput(): ?array {
        $json = file_get_contents("php://input");
        return json_decode(self::sanitize($json), true);
    }
}

/*
********************Örnek kullanımlar :
<?php
require_once __DIR__ . '/models/Security.php';

// Singleton örneğini al
$security = Security::getInstance();

// Güvenli POST verisi al
$username = Security::securePost('username');
$password = Security::securePost('password');

// Güvenli GET verisi al
$search = Security::secureGet('search');

// CSRF Token oluştur ve doğrula
$token = Security::generateCsrfToken();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !Security::verifyCsrfToken($_POST['csrf_token'])) {
    die("Güvenlik hatası! CSRF Token geçersiz.");
}

// Güvenli JSON veri al
$jsonData = Security::secureJsonInput();

// Kullanıcı IP adresini al
$userIp = Security::getClientIP();
?>

*/


?>
