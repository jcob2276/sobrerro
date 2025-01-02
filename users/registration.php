<?php
require('db.php');

if (!isset($_SESSION)) {
    session_start(); // Upewniamy się, że sesja jest uruchomiona
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generowanie tokenu CSRF
}

// Inicjalizacja zmiennych na błędy
$errors = ['name' => '', 'email' => '', 'password' => '', 'username' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $recaptcha_secret = "6LcAKJ4qAAAAAC9RrfbOMY3vkhCL6R69KDKEbYUh"; // Twój tajny klucz
    $recaptcha_response = $_POST['g-recaptcha-response']; // Odpowiedź reCAPTCHA z formularza

    // Weryfikacja reCAPTCHA z serwerem Google
    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents("$verify_url?secret=$recaptcha_secret&response=$recaptcha_response");
    $response_data = json_decode($response);

    // Jeśli reCAPTCHA jest niepoprawna
    if (!$response_data->success) {
        die("<div style='color:red;'>Weryfikacja reCAPTCHA nie powiodła się. Spróbuj ponownie.</div>");
    }



    // Pobranie i walidacja 

    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Walidacja danych wejściowych
    if (!preg_match("/^[a-zA-Z]+$/", $name)) {
        $errors['name'] = "Imię może zawierać tylko litery.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Niepoprawny format adresu email.";
    }

    if (strlen($password) < 8 || !preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $errors['password'] = "Hasło musi mieć minimum 8 znaków, zawierać litery i cyfry.";
    }

    // Sprawdzenie, czy login lub e-mail już istnieją
    $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $con->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors['username'] = "Podany login lub e-mail już istnieje.";
    }

    // Jeśli brak błędów, przystępujemy do rejestracji
    if (empty(array_filter($errors))) {
        $name = mysqli_real_escape_string($con, $name);
        $username = mysqli_real_escape_string($con, $username);
        $email = mysqli_real_escape_string($con, encryptData($email)); // Szyfrowanie e-maila

        $salt = bin2hex(random_bytes(16));
        $password_with_salt = $salt . $password;
        $hashed_password = password_hash($password_with_salt, PASSWORD_BCRYPT);
        $create_datetime = date("Y-m-d H:i:s");

        $query = "INSERT INTO users (name, username, email, password, salt, create_datetime)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssssss", $name, $username, $email, $hashed_password, $salt, $create_datetime);
        $result = $stmt->execute();

        if ($result) {
            // Wysyłanie e-maila z potwierdzeniem
            $to = trim($_POST['email']);
            $subject = "Potwierdzenie rejestracji w Sombrerro";
            $message = "Cześć $name!\n\nTwoje konto zostało pomyślnie utworzone w Sombrerro.\n\nDziękujemy za rejestrację!\n\nZespół Sombrerro.";
            $headers = "From: sobrerro@jakubsobon.pl\r\n";
            $headers .= "Reply-To: sobrerro@jakubsobon.pl\r\n";
            $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

            if (mail($to, $subject, $message, $headers)) {
                echo "<script>
                        alert('Pomyślnie zarejestrowano! Potwierdzenie wysłano na Twój e-mail.');
                        window.location.href = 'login.php';
                      </script>";
            } else {
                echo "<div style='color:red;'>Konto utworzono, ale nie udało się wysłać e-maila z potwierdzeniem.</div>";
            }
        } else {
            error_log("Błąd SQL: " . $stmt->error, 3, "error_log.log");
            echo "<div style='color:red;'>Błąd podczas rejestracji. Spróbuj ponownie później.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Sombrerro | Rejestracja</title>
    <link rel="stylesheet" href="../zasoby/css/login.css" />
</head>

<body>
    <form id="registrationForm" class="form" action="" method="post">
        <center>
            <img src="../zasoby/zdjecia/logo.png" alt="" class="img img-fluid">
        </center>
        <hr />
        <h1 class="login-title">Zarejestruj się</h1>

        <!-- Imię -->
        <input type="text" class="login-input" name="name" placeholder="Imię"
            value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required />
        <span class="validation-message"><?= $errors['name']; ?></span>

        <!-- Login -->
        <input type="text" class="login-input" name="username" placeholder="Login"
            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required />
        <span class="validation-message"><?= $errors['username']; ?></span>

        <!-- Email -->
        <input type="text" class="login-input" name="email" placeholder="Email"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />
        <span class="validation-message"><?= $errors['email']; ?></span>

        <!-- Hasło -->
        <input type="password" class="login-input" name="password" placeholder="Hasło" required />
        <span class="validation-message"><?= $errors['password']; ?></span>

        <!-- Przycisk Zarejestruj się -->
        <input type="submit" name="submit" value="Zarejestruj się" class="login-button">
        <br>
        <!-- Dodaj poniżej pola z przyciskiem submit -->
        <div class="g-recaptcha" data-sitekey="6LcAKJ4qAAAAAP0TNbbpUZUnNV1rvxmCCbTGajY6"></div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <p class="link">Posiadasz już konto? <a href="login.php">Zaloguj się!</a></p>
    </form>

    <link rel="stylesheet" href="../zasoby/css/validation.css">
    <script src="../zasoby/js/validation.js"></script>
</body>

</html>