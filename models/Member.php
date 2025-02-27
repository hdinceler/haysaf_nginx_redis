<?php
namespace App; // xcomposer in App namespace i altında çalışabilmesi için

require_once __DIR__ . '/Security.php'; // Security sınıfını dahil ediyoruz.
require_once __DIR__ . '/Mail.php'; // Security sınıfını dahil ediyoruz.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Member {
    private $DB;

    public function __construct() {
        $this->DB = Database::getInstance();
        session_start(); // Oturum yönetimi başlatılıyor
    }

    // Kullanıcı oturum kontrolü (Giriş yapılmış mı?)
    public function isLogged() {
        return isset($_SESSION['user_id']) && isset($_SESSION['email']);
    }

    // Kullanıcı giriş işlemi (Login)
    public function login($email, $password) {
        $email = Security::sanitize($email);
        $password = Security::sanitize($password);

        // SQL sorgusu
        $sql = "SELECT * FROM members WHERE email = ?";
        $result = $this->DB->select($sql, [$email]);

        if (count($result) == 0) {
            return json_encode(['status' => 'error', 'message' => 'E-mail or password is incorrect']);
        }

        $user = $result[0];
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            return json_encode(['status' => 'success', 'message' => 'Login successful']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'E-mail or password is incorrect']);
        }
    }

    // Kullanıcı kaydını kontrol et (Kullanıcı kayıtlı mı?)
    public function isRegistered($email) {
        $email = Security::sanitize($email);
        $sql = "SELECT * FROM members WHERE email = ?";
        $result = $this->DB->select($sql, [$email]);

        return count($result) > 0
            ? json_encode(['status' => 'success', 'message' => 'User is registered'])
            : json_encode(['status' => 'error', 'message' => 'User not registered']);
    }

    // Kullanıcı kaydı
    public function register($email, $password1, $password2) {
        $email = Security::sanitize($email);
        $password1 = Security::sanitize($password1);
        $password2 = Security::sanitize($password2);
    
        // 1. E-posta geçerli biçimde mi?
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid email format']);
        }
    
        // 2. E-posta veritabanında önceden mevcut mu?
        $sql = "SELECT * FROM members WHERE email = ?";
        $result = $this->DB->select($sql, [$email]);
        if (count($result) > 0) {
            return json_encode(['status' => 'error', 'message' => 'Email is already registered']);
        }
    
        // 3. password1 ile password2 aynı mı?
        if ($password1 !== $password2) {
            return json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
        }
    
        // 4. password1 ve password2 belirtilen regex'e uyuyor mu?
        $regexPassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,32}$/";
        if (!preg_match($regexPassword, $password1)) {
            return json_encode(['status' => 'error', 'message' => 'Password does not meet the required format']);
        }
    
        // Şifreyi güvenli bir şekilde hashliyoruz
        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
    
        // Aktivasyon kodu üret
        $activationCode = bin2hex(random_bytes(16)); // Benzersiz bir aktivasyon kodu oluştur
    
        // Yeni kullanıcıyı veritabanına ekliyoruz
        $sql = "INSERT INTO members (email, password, activated, activationWaiting, activationCode, registerTime) 
                VALUES (?, ?, 0, 1, ?, UNIX_TIMESTAMP())";
        $userId = $this->DB->insert($sql, [$email, $hashedPassword, $activationCode]);

        // Kayıt başarılıysa success, başarısızsa error mesajı döndürüyoruz
        if ($userId) {
            $mailReport= json_decode($this->sendActivationLink($email, $activationCode),true);
            if($mailReport['status']=='success'){
                return json_encode(['status' => 'success', 'message' => 'Registration successful, please check your email for activation']);
            }else{
                return json_encode(['status' => 'warning', 'message' => 'Registration successful, but activation email could not be sent. Error: ' . $mailReport['message']]);
            }
        } else {
            return json_encode(['status' => 'error', 'message' => 'Registration failed']);
        }
    }

    // Aktivasyon linki gönderme
    private function sendActivationLink($email, $activationCode) {
        $activationLink = "http://haysaf.com/activateMember?email=" . urlencode($email) . "&activationCode=" . $activationCode;

        $mail = new PHPMailer(true);
        try {
            // Sunucu ayarları
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP sunucusu
            $mail->SMTPAuth = true;
            $mail->Username = 'your_mailtrap_username';
            $mail->Password = 'your_mailtrap_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Alıcılar
            $mail->setFrom('no-reply@haysaf.com', 'Haysaf');
            $mail->addAddress($email); // Alıcı

            // İçerik
            $mail->isHTML(true);
            $mail->Subject = 'Activate Your Account';
            $mail->Body    = "Please click the following link to activate your account: <a href=\"$activationLink\">Activate Now</a>";

            // E-posta gönderimi
            $mail->send();
            return json_encode(['status' => 'success', 'message' => 'Activation link has been sent to your email']);
        } catch (Exception $e) {
            return json_encode(['status' => 'error', 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
        }
    }

    // Parola sıfırlama talebi
    public function forgotPassword($email) {
        $email = Security::sanitize($email);
        $sql = "SELECT * FROM members WHERE email = ?";
        $result = $this->DB->select($sql, [$email]);

        if (count($result) == 0) {
            return json_encode(['status' => 'error', 'message' => 'Email address not registered']);
        }

        // Token oluştur
        $token = bin2hex(random_bytes(32)); // Benzersiz bir token oluştur
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour')); // 1 saat geçerli olacak

        // Token'ı password_resets tablosuna kaydet
        $sql = "INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)";
        $this->DB->insert($sql, [$email, $token, $expiresAt]);

        // Parola sıfırlama bağlantısını e-posta ile gönder
        $resetLink =App\Vars::siteAddress. "/reset-password?token=" . $token;
        mail($email, "Password Reset Request", "Click the following link to reset your password: " . $resetLink);

        return json_encode(['status' => 'success', 'message' => 'Password reset link has been sent to your email']);
    }

    // Parola sıfırlama
    public function resetPassword($token, $newPassword) {
        // CSRF Token doğrulaması
        if (!Security::verifyCsrfToken($_POST['csrf_token'])) {
            return json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']);
        }

        // Token'ı doğrula ve geçerliliğini kontrol et
        $sql = "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()";
        $result = $this->DB->select($sql, [Security::sanitize($token)]);

        if (count($result) == 0) {
            return json_encode(['status' => 'error', 'message' => 'Invalid or expired token']);
        }

        // Kullanıcıyı bul
        $email = Security::sanitize($result[0]['email']);

        // Yeni parolayı güvenli bir şekilde hashle
        $hashedPassword = password_hash(Security::sanitize($newPassword), PASSWORD_DEFAULT);

        // Kullanıcının parolasını güncelle
        $sql = "UPDATE members SET password = ? WHERE email = ?";
        $this->DB->update($sql, [$hashedPassword, $email]);

        // Token'ı sil
        $sql = "DELETE FROM password_resets WHERE token = ?";
        $this->DB->delete($sql, [Security::sanitize($token)]);

        return json_encode(['status' => 'success', 'message' => 'Password has been reset successfully']);
    }

    // Kullanıcı çıkışı (logout)
    public function logout() {
        session_unset();
        session_destroy();
        return json_encode(['status' => 'success', 'message' => 'Logout successful']);
    }
}
?>
