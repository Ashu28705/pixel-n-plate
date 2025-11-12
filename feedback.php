<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $rating  = $_POST['rating'];
    $message = $_POST['message'];

    $sql = "INSERT INTO feedback (name, email, rating, message)
            VALUES ('$name', '$email', '$rating', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>✅ Thank you for your feedback, $name!</h2>";
            echo '<a href="index.html" style="
        display:inline-block;
        margin-top:15px;
        padding:10px 20px;
        background-color:#ff8a00;
        color:white;
        text-decoration:none;
        border-radius:8px;
        font-weight:bold;">🏠 Back to Home</a>';

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
