<?php
header("Content-Type: text/plain"); // Zapewnij, że odpowiedź jest czystym tekstem

// Połączenie z bazą danych
$con = mysqli_connect("localhost", "serwer314716", "Wielorybhipis32!", "serwer314716_sobrerro");

// Sprawdzamy połączenie
if (mysqli_connect_errno()) {
    echo "Błąd połączenia z bazą danych.";
    exit();
}

// Sprawdzenie, czy dane zostały przesłane
if(isset($_POST['email']) && isset($_POST['message'])) {
    // Pobranie danych z formularza
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Walidacja danych
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {

        // Przygotowanie zapytania SQL
        $stmt = $con->prepare("INSERT INTO contact_form (email, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $message);

        // Wykonanie zapytania
        if ($stmt->execute()) {
            echo "Dziękujemy za wiadomość!";
        } else {
            echo "Wystąpił błąd. Spróbuj ponownie później.";
        }

        $stmt->close();
    } else {
        echo "Nieprawidłowy adres email lub puste pole wiadomości.";
    }
} else {
    echo "Proszę wypełnić wszystkie pola.";
}

// Zamykamy połączenie
$con->close();
?>
