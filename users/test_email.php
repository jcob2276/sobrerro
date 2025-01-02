<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer.php';
require 'vendor/SMTP.php';
require 'vendor/Exception.php';

$mail = new PHPMailer(true);

try {
    // Konfiguracja SMTP
    $mail->isSMTP();
    $mail->Host = 'mail-serwer314716.lh.pl'; // Adres SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'sobrerro@jakubsobon.pl'; // Twój e-mail
    $mail->Password = 'Wielorybhipis32!'; // Hasło do konta pocztowego
    $mail->SMTPSecure = 'ssl'; // Użyj SSL
    $mail->Port = 465;

    // Ustawienia odbiorcy
    $mail->setFrom('sobrerro@jakubsobon.pl', 'Sombrerro'); // Nadawca
    $mail->addAddress('jakubsobon3@gmail.com', 'Jakub'); // Odbiorca

    // Treść e-maila
    $mail->isHTML(true);
    $mail->Subject = 'Testowa wiadomość';
    $mail->Body = 'To jest <b>testowa wiadomość</b> wysłana z użyciem PHPMailer i SMTP.';
    $mail->AltBody = 'To jest testowa wiadomość wysłana z użyciem PHPMailer i SMTP.';

    // Wyślij e-mail
    $mail->send();
    echo 'Wiadomość została pomyślnie wysłana!';
} catch (Exception $e) {
    echo "Wiadomość nie została wysłana. Błąd: {$mail->ErrorInfo}";
}
?>
