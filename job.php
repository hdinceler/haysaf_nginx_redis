<?php 
// echo json_encode(['error' => 'Geçersiz istek'], JSON_UNESCAPED_UNICODE);

// var_dump($_GET["job"]);
 
// Geçerli modüller listesi
$allowedJobs = [
    '/'               => 'defaultModule.php',
    'member'          => 'member/index.php',
    'logout'          => 'member/logout.php',
    'register'        => 'member/register.php',
    'resetPassword'   => 'member/resetPassword.php',
    'memberProfile'   => 'member/profile/index.php',
    'api/login'       => '/api/member.php',
    'urunler'         => '/urun/index.php',
    'kategoriler'     => '/kategoriler.php',
    'saticilar'       => '/Satici/index.php',
    'iletisim'        => 'iletisim.php',
    'getProductSellers' => 'getProductSellers.php',
];

// `job` parametresini güvenli hale getir
$job = isset($_GET['job']) ? $Security->sanitize($_GET['job']) : '';

// Modül dosyası varsa çalıştır
if (array_key_exists($job, $allowedJobs)) {
    $modulePath = __DIR__ . "/modules/" . $allowedJobs[$job];

    if (file_exists($modulePath)) {
        require_once $modulePath;
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Modül bulunamadı']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Geçersiz istek']);
}
?>