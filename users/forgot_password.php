<?php
require('db.php');
require 'vendor/PHPMailer.php';
require 'vendor/SMTP.php';
require 'vendor/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Szyfrowanie e-maila przed sprawdzeniem w bazie
    $encrypted_email = encryptData($email);

    // Sprawdzenie, czy e-mail istnieje w bazie
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $encrypted_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generowanie tokenu
        $token = bin2hex(random_bytes(16));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Zapis tokenu do bazy
        $query = "UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sss", $token, $expiry, $encrypted_email);
        $stmt->execute();

        // Wysłanie e-maila z linkiem resetującym
        $link = "https://jakubsobon.pl/users/reset_password.php?token=$token";
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'mail-serwer314716.lh.pl';
            $mail->SMTPAuth = true;
            $mail->Username = 'sobrerro@jakubsobon.pl';
            $mail->Password = 'Wielorybhipis32!';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('sobrerro@jakubsobon.pl', 'Sombrerro');
            $mail->addAddress($email);
            $mail->Subject = 'Resetowanie hasła';
            $mail->Body = "Kliknij w poniższy link, aby zresetować swoje hasło: <a href='$link'>$link</a>";
            $mail->isHTML(true);

            $mail->send();
            echo "<div style='color:green;'>E-mail z linkiem resetującym został wysłany.</div>";
        } catch (Exception $e) {
            echo "<div style='color:red;'>Błąd wysyłania e-maila: {$mail->ErrorInfo}</div>";
        }
    } else {
        echo "<div style='color:red;'>Nie znaleziono użytkownika z takim adresem e-mail.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Odzyskiwanie hasła</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        form {
            display: inline-block;
            background: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input[type="email"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Odzyskiwanie hasła</h1>
    <form method="POST">
        <label>Podaj swój adres e-mail:</label>
        <input type="email" name="email" placeholder="Wpisz e-mail" required>
        <button type="submit">Wyślij</button>
    </form>
</body>
</html>
