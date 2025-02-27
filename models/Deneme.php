<?php 
namespace App; // xcomposer in App namespace i altında çalışabilmesi için

require_once __DIR__ . '/Mail.php'; // Security sınıfını dahil ediyoruz.
class Deneme{
    private function __construct(){}

    public static function merhaba(){
         $mailConfig= GlobalVars::get('smtp');
         
        $mail=Mail::getInstance();
        $targetMail='hdinceler@gmail.com';
        $subject='merhaba';
        $message = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                padding: 20px;
            }
            h1 {
                color: #0066cc;
            }
            p {
                font-size: 16px;
            }
            .container {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Merhaba!</h1>
            <p>Bu, CSS ile biçimlendirilmiş bir HTML e-posta içeriğidir.</p>
        </div>
    </body>
    </html>
';
// $mail->setFrom('bilgi@haysaf.com', 'Haysaf Teknoloji');
    $mail->getSmtp()->setFrom('bilgi@haysaf.com', 'Haysaf İletişim');
    $response= $mail->sendSingle($targetMail,$subject,$message);
    var_dump($response);         
    }

}