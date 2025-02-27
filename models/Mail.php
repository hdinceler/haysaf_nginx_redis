<?php
namespace App; // xcomposer in App namespace i altında çalışabilmesi için

// models/Mail.php
require_once './models/Vars.php';

// PHPMailer sınıfını dahil ediyoruz. (PHPMailer'ı composer ile yüklemeniz gerekebilir)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . "/PHPMailer/Exception.php";
require_once __DIR__ . "/PHPMailer/PHPMailer.php";
require_once __DIR__ . "/PHPMailer/SMTP.php";

class Mail {
    private $smtp;
    private $waitTime = 10;  // Eğer bir e-posta gönderimi hata verirse veya 10 saniye içinde cevap gelmezse, işlemi durdur ve sonraki e-postaya geç
    private static $instance = null; // Singleton örneği

    // Yapıcı fonksiyonu private yapıyoruz
    private function __construct() {
        $Vars= App\Vars::getInstance();  // App\Vars instance'ı alıyoruz
        $smtpConfig = App\Vars::get('smtp');  // App\Vars sınıfından 'smtp' ayarlarını alıyoruz

        $this->smtp = new PHPMailer(true);  // PHPMailer sınıfını başlatıyoruz
        $this->smtp->isSMTP();
        $this->smtp->Host = $smtpConfig->host;
        $this->smtp->SMTPAuth = $smtpConfig->auth;
        $this->smtp->Username = $smtpConfig->username;
        $this->smtp->Password = $smtpConfig->password;
        $this->smtp->SMTPSecure = $smtpConfig->encryption;
        $this->smtp->Port = $smtpConfig->port;
        
        // Gönderen bilgisi
        $this->smtp->setFrom($smtpConfig->username,  App\Vars->get('siteName'));
    }
 
    // Singleton metodunu kullanarak örnek oluşturma
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Tek bir e-posta gönderme fonksiyonu
    public function sendSingle($targetMail, $subject, $message) {
        try {
            // Alıcı bilgilerini ayarlıyoruz
            $this->smtp->clearAddresses();
            $this->smtp->addAddress($targetMail);
            $this->smtp->Subject = $subject;
            $this->smtp->Body    = $message;
            $this->smtp->isHTML(true);

            // E-posta gönderme
            $this->smtp->send();
            return json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
        } catch (Exception $e) {
            return json_encode(['status' => 'error', 'message' => 'Message could not be sent. Mailer Error: ' . $this->smtp->ErrorInfo]);
        }
    }

    // Getter metoduyla $smtp'ye erişim sağlıyoruz
    public function getSmtp() {
        return $this->smtp;
    }  

    // Toplu e-posta gönderme fonksiyonu
    public function sendMass($targetMailList, $subject, $message) {
        $successMailList = [];
        $failMailList = [];

        // E-posta gönderimi yapılacak her bir adres için döngü
        foreach ($targetMailList as $targetMail) {
            $response = $this->sendSingle($targetMail, $subject, $message);
            $response = json_decode($response, true);

            if ($response['status'] == 'success') {
                $successMailList[] = $targetMail;
            } else {
                $failMailList[$targetMail] = $response['message'];
            }
        }

        return json_encode([
            'status' => 'success',
            'sent' => $successMailList,
            'failed' => $failMailList
        ]);
    }
}
