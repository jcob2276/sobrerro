<?php
// Włączanie raportowania błędów
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('db.php'); // Połączenie z bazą danych
session_start();

$lock_message = ""; // Przechowuje komunikat o blokadzie

if (!$con) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Kiedy formularz zostanie przesłany
if (isset($_POST['username'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);

    // Pobierz dane użytkownika na podstawie username
    $query = "SELECT password, salt, failed_attempts, last_attempt FROM `users` WHERE username = ?";
    $stmt = $con->prepare($query);

    if (!$stmt) {
        die("Błąd przygotowania zapytania: " . $con->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $failed_attempts = $user['failed_attempts'];
        $last_attempt = $user['last_attempt'] ? strtotime($user['last_attempt']) : 0;
        $now = time();

        // Sprawdzenie blokady konta
        if ($failed_attempts >= 3 && ($now - $last_attempt) < 10) {
            $lock_message = "Twoje konto zostało zablokowane na 10 sekund z powodu zbyt wielu nieudanych prób logowania.";
        } else {
            // Sprawdzenie, czy czas blokady minął
            if (($now - $last_attempt) >= 10) {
                // Zerowanie liczby prób po upływie 10 sekund minut
                $failed_attempts = 0;
                $stmt = $con->prepare("UPDATE users SET failed_attempts = 0 WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
            }

            // Połączenie hasła z solą i sprawdzenie
            $salt = $user['salt'];
            $password_with_salt = $salt . $password;

            if (password_verify($password_with_salt, $user['password'])) {
                // Zresetowanie liczby prób przy udanym logowaniu
                $stmt = $con->prepare("UPDATE users SET failed_attempts = 0 WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();

                // Logowanie udane
                $_SESSION['username'] = $username;
                unset($_SESSION['csrf_token']);
                header("Location: index.php");
                exit();
            } else {
                // Aktualizacja prób logowania
                $failed_attempts++;
                $stmt = $con->prepare("UPDATE users SET failed_attempts = ?, last_attempt = NOW() WHERE username = ?");
                $stmt->bind_param("is", $failed_attempts, $username);
                $stmt->execute();

                $lock_message = "Niepoprawne hasło. Próba: $failed_attempts z 3.";
            }
        }
    } else {
        $lock_message = "Nie znaleziono użytkownika!";
    }

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Sombrerro | Login</title>
    <link rel="stylesheet" href="../zasoby/css/login.css" />
</head>

<body>
    <form class="form" method="post" name="login">
        <center>
            <img src="../zasoby/zdjecia/logo.png" alt="" class="img img-fluid">
        </center>
        <hr />
        <h1 class="login-title">Logowanie</h1>

        <?php if (!empty($lock_message)): ?>
            <div class="error-message" style="color:red; font-weight:bold; margin-bottom:10px;">
                <?= htmlspecialchars($lock_message) ?>
            </div>
        <?php endif; ?>

        <input type="text" class="login-input" name="username" placeholder="Login" autofocus="true" />
        <input type="password" class="login-input" name="password" placeholder="Hasło" />
        <input type="submit" value="Zaloguj się" name="submit" class="login-button" />
        <p class="link">Nie masz jeszcze konta? <a href="registration.php">Zarejestruj się!</a></p>
        <p class="link">Nie pamiętasz hasła? <a href="forgot_password.php">Resetuj hasło</a></p>

    </form>
</body>

</html>