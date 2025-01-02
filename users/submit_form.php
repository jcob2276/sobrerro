<?php
// Połączenie z bazą danych
$con = mysqli_connect("localhost", "serwer314716", "Wielorybhipis32!", "serwer314716_sobrerro");

// Sprawdzamy połączenie
if (mysqli_connect_errno()) {
    echo "Nie udało połączyć się z MySQL: " . mysqli_connect_error();
    exit();
}

// Debugowanie: sprawdźmy, czy dane zostały odebrane
if(isset($_POST['email']) && isset($_POST['message'])) {
    echo "Otrzymano dane: " . $_POST['email'] . " | " . $_POST['message']; // Debugowanie
} else {
    echo "Brak danych"; // Debugowanie, jeśli coś nie działa
}

// Pobieramy dane z formularza
$email = $_POST['email'];
$message = $_POST['message'];

// Sprawdzamy, czy dane są poprawnie wypełnione
if (!empty($email) && !empty($message)) {
    // Przygotowanie zapytania SQL (zabezpieczenie przed SQL Injection)
    $stmt = $con->prepare("INSERT INTO contact_form (email, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $message); // "ss" oznacza, że oba parametry są typu string

    // Wykonanie zapytania
    if ($stmt->execute()) {
        echo "Dziękujemy za wiadomość!";
    } else {
        error_log("Błąd: " . $stmt->error); // Logowanie błędu do pliku
        echo "Błąd: " . $stmt->error;
    }

    // Zamknięcie przygotowanego zapytania
    $stmt->close();
} else {
    echo "Proszę wypełnić wszystkie pola.";
}

// Zamykamy połączenie
$con->close();
?>
