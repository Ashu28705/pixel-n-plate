<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

$name    = trim($_POST['name']);
$email   = trim($_POST['email']);
$message = trim($_POST['message']);

$responseTitle = '';
$responseText = '';
$responseType = '';

$stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
if ($stmt) {
    $stmt->bind_param('sss', $name, $email, $message);
    if ($stmt->execute()) {
        $responseTitle = '📧 Message Sent!';
        $responseText = sprintf('Thank you, %s. We will reach out to you soon.', htmlspecialchars($name));
        $responseType = 'success';
    } else {
        $responseTitle = '❌ Submission Failed';
        $responseText = 'Unable to send your message. Please try again later.';
        $responseType = 'error';
    }
    $stmt->close();
} else {
    $responseTitle = '❌ Submission Failed';
    $responseText = 'Unable to prepare the contact request.';
    $responseType = 'error';
}
$conn->close();
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact Received - Pixel n Plate</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-nav">
  <div class="site-brand"><img src="images/logo.jpg" alt=""><strong>Pixel n Plate</strong></div>
  <nav class="nav-links"><a href="index.html">Home</a><a href="menu.html">Menu</a><a href="games.html">Games</a><a href="events.html">Events</a><a href="feedback.html">Feedback</a></nav>
</header>

<div class="container">
  <div class="success-card">
    <h2><?php echo $responseTitle; ?></h2>
    <p><?php echo $responseText; ?></p>
    <div style="margin-top:18px;">
      <a href="contact.html" class="button">Send Another Message</a>
      <a href="index.html" class="button secondary">Back to Home</a>
    </div>
  </div>
</div>

<footer class="site-foot">© 2025 Pixel n Plate</footer>
<script src="main.js"></script>
</body>
</html>
