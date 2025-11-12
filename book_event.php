<?php
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $event_type = $_POST['event'];
    $event_date = $_POST['date'];
    $notes      = $_POST['notes'];

    $sql = "INSERT INTO bookings (name, email, phone, event_type, event_date, notes)
            VALUES ('$name', '$email', '$phone', '$event_type', '$event_date', '$notes')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>🎉 Booking Confirmed!</h2>";
        echo "<p>Thank you, $name. Your booking for <strong>$event_type</strong> on <strong>$event_date</strong> has been saved.</p>";
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
