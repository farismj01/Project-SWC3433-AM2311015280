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

$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPedia - Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>HotelPedia</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="rooms.html">Rooms & Suites</a></li>
                    <li><a href="amenities.html">Amenities</a></li>
                    <li><a href="reservation.html">Reservation</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="admin-dashboard">
            <div class="container">
                <h2>Admin Dashboard</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Room Type</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['room_type']}</td>
                                    <td>{$row['check_in']}</td>
                                    <td>{$row['check_out']}</td>
                                    <td>
                                        <a href='admin_edit.php?id={$row['id']}'>Edit</a> |
                                        <a href='admin_delete.php?id={$row['id']}'>Delete</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No reservations found.</td></tr>";
                    }
                    ?>
                </table>
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
