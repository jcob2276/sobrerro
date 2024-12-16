<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    die("Błąd: Użytkownik nie jest zalogowany.");
}

$user = $_SESSION['username'];

// Pobierz ID użytkownika
$sql1 = "SELECT id FROM users WHERE username = ?";
$stmt = $con->prepare($sql1);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Błąd: Użytkownik nie istnieje w bazie danych.");
}
$userData = $result->fetch_assoc();
$userId = $userData['id'];

// Sprawdź, czy przesłano `order_id` (dla "Zamów ponownie")
if (isset($_POST['order_id'])) {
    $orderId = intval($_POST['order_id']);

    // Pobierz dane zamówienia na podstawie `order_id`
    $sql2 = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
    $stmt = $con->prepare($sql2);
    $stmt->bind_param("ii", $orderId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        die("Błąd: Zamówienie nie istnieje lub należy do innego użytkownika.");
    }
    $order = $result->fetch_assoc();

    // Ponowne dodanie zamówienia
    $date = date('Y-m-d');
    $invoiceNumber = uniqid("INV");
    $sql3 = "INSERT INTO orders (price, title, quantity, subtotal_amount, date, invoice_number, user_id)
         VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql3);
if (!$stmt) {
    die("Błąd przygotowania zapytania: " . $con->error);
}

// Poprawiony ciąg typów
$stmt->bind_param(
    "dsidssi", // double, string, int, double, string, string, int
    $order['price'],            // 1. double (np. 15.00)
    $order['title'],            // 2. string (np. "NITRO COLD BREW")
    $order['quantity'],         // 3. int (np. 20)
    $order['subtotal_amount'],  // 4. double (np. 300.00)
    $date,                      // 5. string (np. "2024-12-14")
    $invoiceNumber,             // 6. string (np. "INV675de6107c00...")
    $userId                     // 7. int (np. 10)
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Zamówienie zostało ponowione.'], JSON_UNESCAPED_UNICODE);
} else {
    die("Błąd wykonania zapytania: " . $stmt->error);
}

    header("Location: index.php#recent-orders");
    exit();

}

// Obsługa nowych zamówień (domyślna)
$orderDetails = json_decode(file_get_contents('php://input'), true);
if (empty($orderDetails)) {
    die("Błąd: Brak danych zamówienia.");
}

$date = date('Y-m-d');
foreach ($orderDetails as $order) {
    $title = $order['title'];
    $price = $order['price'];
    $quantity = $order['quantity'];
    $subtotalAmount = $order['subtotal_amount'];
    $invoiceNumber = $order['invoice_number'];
    $sql4 = "INSERT INTO orders (price, title, quantity, subtotal_amount, date, invoice_number, user_id) 
             VALUES ('$price', '$title', '$quantity', '$subtotalAmount', '$date', '$invoiceNumber', '$userId')";
    if ($con->query($sql4) !== TRUE) {
        die("Błąd SQL: " . $con->error . " w zapytaniu: " . $sql4);
    }
}

echo json_encode(['status' => 'success', 'message' => 'Złożono zamówienie.']);
$con->close();
?>
