<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: feedback.html');
    exit;
}

$name    = trim($_POST['name']);
$email   = trim($_POST['email']);
$rating  = trim($_POST['rating']);
$message = trim($_POST['message']);

$responseTitle = '';
$responseText = '';
$responseType = '';

$stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, message) VALUES (?, ?, ?, ?)");
if ($stmt) {
    $stmt->bind_param('ssss', $name, $email, $rating, $message);
    if ($stmt->execute()) {
        $responseTitle = '✅ Feedback Received';
        $responseText = sprintf('Thank you, %s! Your feedback has been recorded.', htmlspecialchars($name));
        $responseType = 'success';
    } else {
        $responseTitle = '❌ Submission Failed';
        $responseText = 'Unable to submit your feedback at the moment. Please try again later.';
        $responseType = 'error';
    }
    $stmt->close();
} else {
    $responseTitle = '❌ Submission Failed';
    $responseText = 'Unable to prepare the feedback request.';
    $responseType = 'error';
}
$conn->close();
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Feedback Submitted - Pixel n Plate</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-nav">
  <div class="site-brand"><img src="images/logo.jpg" alt=""><strong>Pixel n Plate</strong></div>
  <nav class="nav-links"><a href="index.html">Home</a><a href="menu.html">Menu</a><a href="games.html">Games</a><a href="events.html">Events</a><a href="contact.html">Contact</a></nav>
</header>

<div class="container">
  <div class="success-card">
    <h2><?php echo $responseTitle; ?></h2>
    <p><?php echo $responseText; ?></p>
    <div style="margin-top:18px;">
      <a href="feedback.html" class="button">Submit More Feedback</a>
      <a href="index.html" class="button secondary">Back to Home</a>
    </div>
  </div>
</div>

<footer class="site-foot">© 2025 Pixel n Plate</footer>
<script src="main.js"></script>
</body>
</html>
