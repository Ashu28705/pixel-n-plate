<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: book-event.html');
    exit;
}

$name       = trim($_POST['name']);
$email      = trim($_POST['email']);
$phone      = trim($_POST['phone']);
$event_type = trim($_POST['event']);
$event_date = trim($_POST['date']);
$notes      = trim($_POST['notes']);

$responseTitle = '';
$responseText = '';
$responseType = '';

$stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, event_type, event_date, notes) VALUES (?, ?, ?, ?, ?, ?)");
if ($stmt) {
    $stmt->bind_param('ssssss', $name, $email, $phone, $event_type, $event_date, $notes);
    if ($stmt->execute()) {
        $responseTitle = '🎉 Booking Confirmed!';
        $responseText = sprintf('Thank you, %s. Your booking for <strong>%s</strong> on <strong>%s</strong> has been saved.', htmlspecialchars($name), htmlspecialchars($event_type), htmlspecialchars($event_date));
        $responseType = 'success';
    } else {
        $responseTitle = '❌ Booking Failed';
        $responseText = 'We could not save your booking. Please try again later.';
        $responseType = 'error';
    }
    $stmt->close();
} else {
    $responseTitle = '❌ Booking Failed';
    $responseText = 'Unable to prepare the booking request.';
    $responseType = 'error';
}
$conn->close();
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Booking Result - Pixel n Plate</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-nav">
  <div class="site-brand"><img src="images/logo.jpg" alt=""><strong>Pixel n Plate</strong></div>
  <nav class="nav-links"><a href="index.html">Home</a><a href="menu.html">Menu</a><a href="games.html">Games</a><a href="events.html">Events</a><a href="contact.html">Contact</a><a href="feedback.html">Feedback</a></nav>
</header>

<div class="container">
  <div class="success-card">
    <h2><?php echo $responseTitle; ?></h2>
    <p><?php echo $responseText; ?></p>
    <div style="margin-top:18px;">
      <a href="book-event.html" class="button">Book Another Event</a>
      <a href="index.html" class="button secondary">Back to Home</a>
    </div>
  </div>
</div>

<footer class="site-foot">© 2025 Pixel n Plate</footer>
<script src="main.js"></script>
</body>
</html>
