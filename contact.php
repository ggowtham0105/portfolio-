<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "portfolio_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name    = isset($_POST['name']) ? $_POST['name'] : '';
$email   = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

$sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error executing statement: {$stmt->error}";
    }
} else {
    echo "Error preparing statement: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
