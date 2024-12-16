<?php
include 'db.php';

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['username'])) {
    die("Musisz być zalogowany, aby zobaczyć swoje ostatnie zamówienia.");
}

$user = $_SESSION['username'];

// Pobranie ID użytkownika
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Nie znaleziono użytkownika.");
}
$userData = $result->fetch_assoc();
$userId = $userData['id'];

// Pobranie ostatnich zamówień użytkownika
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC LIMIT 5";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Przetworzenie wyników
$recentOrders = [];
while ($row = $result->fetch_assoc()) {
    $recentOrders[] = $row;
}

// Zamykanie połączenia z bazą danych
$stmt->close();
$con->close();
?>

<!-- Sekcja wyświetlania zamówień -->
<section class="recent-orders" id="recent-orders">
    <h1 class="heading">Ostatnie <span>zamówienia</span></h1>
    <div class="container">
        <?php if (!empty($recentOrders)): ?>
            <div class="row">
                <?php foreach ($recentOrders as $order): ?>
                    <div class="col-md-4">
                        <div class="card order-card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($order['title']); ?></h5>
                                <p class="card-text">
                                    <strong>Ilość:</strong> <?php echo htmlspecialchars($order['quantity']); ?><br>
                                    <strong>Cena:</strong> <?php echo number_format($order['price'], 2); ?> zł<br>
                                    <strong>Łącznie:</strong> <?php echo number_format($order['subtotal_amount'], 2); ?> zł<br>
                                    <strong>Data:</strong> <?php echo htmlspecialchars($order['date']); ?>
                                </p>
                                <form action="add_to_database.php" method="POST">
                                     <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                     <button class="btn btn-dark" onclick="reorder(<?php echo $order['id']; ?>)">Zamów ponownie</button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">Brak ostatnich zamówień.</p>
        <?php endif; ?>
    </div>
</section>
