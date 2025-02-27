<?php
// auto.php - auto model loader file:
//\ php_redis-6.1.0-8.3-ts-vs16-x64 kullan
header("Content-Type:text/html; charset=UTF-8");

// Composer autoloader'ını dahil et
require_once __DIR__ . '/vendor/autoload.php';
$redis = new Redis();
$redis->connect('127.0.0.1', 6379); 
// Gereken sınıfların kullanılması
use App\Security;
use App\Vars;
use App\Database;
use App\Member;
use App\FormElements;
$FormElements= new App\FormElements();
$Member = new App\Member();
$Vars = App\Vars::getInstance();
// var_dump($Vars);

// Güvenlik ve veritabanı sınıflarını başlat
$Security = Security::getInstance();
$Db = Database::getInstance();

// Eğer "logout" parametresi varsa, kullanıcıyı çıkart
if (isset($_GET["job"]) && $_GET["job"] == "logout") {
    $Member->logout();
}
?>
