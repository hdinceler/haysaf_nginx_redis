<?php 
namespace App; // xcomposer in App namespace i altında çalışabilmesi için

class Vars {
    private static $instance = null;
    private $config;

    private function __construct() {
        $this->config = (object) [
            'siteName' => 'Haysaf',
            'siteAddress' => 'http://localhost', // Yerel adres veya sabit URL
            'currency' => 'TRY',
            'timezone' => 'Europe/Istanbul',
            'language' => 'tr',
            'supportEmail' => 'support@example.com',
            'adminEmail' => 'bilgi@haysaf.com',
            'taxRate' => 18,
            'shippingCost' => 50,
            'freeShippingThreshold' => 500,

            'db' => (object) [
                'host' => 'localhost', // Sabit veritabanı hostu
                'name' => 'haysaf', // Sabit veritabanı ismi
                'user' => 'root', // Sabit veritabanı kullanıcı adı
                'password' => '', // Sabit veritabanı şifresi
                'port' => '3306', // Sabit port
                'charset' => 'utf8mb4' // Sabit karakter seti
            ],

            'smtp' => (object) [
                'host' => 'smtp.gmail.com', // Sabit SMTP host
                'auth' => true, // SMTP kimlik doğrulama kullanımı
                'username' => 'hdinceler@gmail.com', // Sabit SMTP kullanıcı adı
                'password' => 'ggzw ftvr zypr cuul', // Sabit SMTP şifresi (uygulama şifresi)
                'encryption' => 'tls', // Sabit şifreleme türü
                'port' => 587 // Sabit port numarası
            ],

            'payment' => (object) [
                'gateway' => 'stripe', // Sabit ödeme geçidi
                'apiKey' => 'your-api-key', // Sabit ödeme API anahtarı
                'secretKey' => 'your-secret-key', // Sabit ödeme gizli anahtarı
                'currency' => 'TRY' // Sabit ödeme para birimi
            ],

            'apiKeys' => (object) [
                'googleMaps' => 'your-google-maps-api-key', // Sabit Google Maps API anahtarı
                'smsGateway' => 'your-sms-gateway-key', // Sabit SMS Gateway API anahtarı
                'shipmentTracking' => 'your-shipment-api-key' // Sabit gönderi takip API anahtarı
            ],

            'siteSettings' => (object) [
                'maintenanceMode' => false, // Sabit bakım modu durumu
                'productsPerPage' => 20, // Sabit ürün sayfa başına
                'reviewsEnabled' => true, // Sabit inceleme etkinliği
                'wishlistEnabled' => true // Sabit istek listesi etkinliği
            ]
        ];
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function get($path) {
        $config = self::getInstance()->config;
        foreach (explode('.', $path) as $part) {
            if (!isset($config->$part)) return null;
            $config = $config->$part;
        }
        return $config;
    }

    private function __clone() {}
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}
