<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $room_type = $_POST['room_type'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    $sql = "UPDATE reservations SET name='$name', email='$email', phone='$phone', room_type='$room_type', check_in='$check_in', check_out='$check_out' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM reservations WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found";
    }
} else {
    header("Location: admin_dashboard.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPedia - Edit Reservation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>HotelPedia</h1>
            </div>
        </div>
    </header>
    <main>
        <section class="edit-reservation">
            <div class="container">
                <h2>Edit Reservation</h2>
                <form action="admin_edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $row['phone']; ?>"><br>
                    <label for="room_type">Room Type:</label>
                    <select id="room_type" name="room_type" required>
                        <option value="Standard Room" <?php if ($row['room_type'] == "Standard Room") echo "selected"; ?>>Standard Room</option>
                        <option value="Double Room" <?php if ($row['room_type'] == "Double Room") echo "selected"; ?>>Double Room</option>
                        <option value="Suites Room" <?php if ($row['room_type'] == "Suites Room") echo "selected"; ?>>Suites Room</option>
                    </select><br>
                    <label for="check_in">Check-in Date:</label>
                    <input type="date" id="check_in" name="check_in" value="<?php echo $row['check_in']; ?>" required><br>
                    <label for="check_out">Check-out Date:</label>
                    <input type="date" id="check_out" name="check_out" value="<?php echo $row['check_out']; ?>" required><br>
                    <input type="submit" value="Update Reservation">
                </form>
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 HotelPedia. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
