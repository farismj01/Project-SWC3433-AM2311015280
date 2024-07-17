<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$room_type = $_POST['room_type'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];

$sql = "INSERT INTO reservations (name, email, phone, room_type, check_in, check_out)
VALUES ('$name', '$email', '$phone', '$room_type', '$check_in', '$check_out')";

if ($conn->query($sql) === TRUE) {
    echo "New reservation created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: review.php");
exit();
?>
