<?php
// Połączenie z bazą danych
$con = mysqli_connect("localhost", "serwer314716", "Wielorybhipis32!", "serwer314716_sobrerro");

// Sprawdzamy połączenie
if (mysqli_connect_errno()) {
    echo "<script>alert('Błąd połączenia z bazą danych. Spróbuj ponownie później.'); window.history.back();</script>";
    exit();
}

// Pobieramy dane z formularza
$email = $_POST['email'];

// Sprawdzamy, czy email jest poprawnie wypełniony
if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Przygotowanie zapytania SQL (zabezpieczenie przed SQL Injection)
    $stmt = $con->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email); // "s" oznacza, że parametr jest typu string

    // Wykonanie zapytania
    if ($stmt->execute()) {
        echo "<script>alert('Dziękujemy za zapisanie się do newslettera!'); window.history.back();</script>";
    } else {
        echo "<script>alert('Wystąpił błąd podczas dodawania do newslettera. Spróbuj ponownie później.'); window.history.back();</script>";
    }

    // Zamknięcie przygotowanego zapytania
    $stmt->close();
} else {
    echo "<script>alert('Podano nieprawidłowy adres e-mail. Spróbuj ponownie.'); window.history.back();</script>";
}

// Zamykamy połączenie
$con->close();
?>
