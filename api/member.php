<?php
// /api/member/register.php fetch api post email&password register api :
require_once __DIR__ ."/../../auto.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Güvenlik için belirli domain ile sınırlandırabilirsiniz
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}

// POST verisini al
$inputJSON = file_get_contents("php://input");
$Member->logout();
$data = json_decode($inputJSON, true);
  print_r($data);
 if( isset($data["job"]) && $data["job"]=="login") {
        echo $Member->isLogged()? "{'status':'error','message':'You Already logged in'}" : $Member->login($data["email"],$data["password"]);
 }
// Gerekli parametreleri kontrol et

// if (!isset($data["email"], $data["password"], $data["job"])) {
//     echo json_encode(["error" => "Eksik parametreler"]);
//     exit;
// }

// // Verileri değişkenlere ata
// $email = trim($data["email"]);
// $password = trim($data["password"]);
// $job = trim($data["job"]);

// // Job değeri "login" değilse hata ver
// if ($job !== "login") {
//     echo json_encode(["error" => "Geçersiz işlem"]);
//     exit;
// }