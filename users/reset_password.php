<?php
require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Weryfikacja tokenu
    $query = "SELECT * FROM users WHERE reset_token = ? AND token_expiry > NOW()";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("Nieprawidłowy lub wygasły token.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Walidacja hasła
    if (strlen($new_password) < 8 || !preg_match("/[A-Za-z]/", $new_password) || !preg_match("/[0-9]/", $new_password)) {
        die("Hasło musi mieć minimum 8 znaków, zawierać litery i cyfry.");
    }

    // Hashowanie nowego hasła
    $salt = bin2hex(random_bytes(16));
    $password_with_salt = $salt . $new_password;
    $hashed_password = password_hash($password_with_salt, PASSWORD_BCRYPT);

    // Aktualizacja hasła
    $query = "UPDATE users SET password = ?, salt = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sss", $hashed_password, $salt, $token);

    if ($stmt->execute()) {
        echo "<div style='color:green; font-weight:bold;'>Hasło zostało zresetowane. Możesz się teraz <a href='login.php'>zalogować</a>.</div>";
    } else {
        echo "<div style='color:red; font-weight:bold;'>Błąd podczas resetowania hasła.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Resetowanie hasła</title>
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
        input[type="password"] {
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
    <h1>Resetowanie hasła</h1>
    <form method="POST">
        <label>Wprowadź nowe hasło:</label>
        <input type="password" name="new_password" placeholder="Wpisz nowe hasło" required>
        <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">
        <button type="submit">Zresetuj hasło</button>
    </form>
</body>
</html>
