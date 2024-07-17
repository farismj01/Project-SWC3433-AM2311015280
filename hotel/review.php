<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPedia - Review Reservation</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function printReservation() {
            window.print();
        }
    </script>
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
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="review">
            <div class="container">
                <h2>Review Your Reservation</h2>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "hotel_db";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM reservations ORDER BY id DESC LIMIT 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<p>Name: " . $row["name"]. "</p>";
                        echo "<p>Email: " . $row["email"]. "</p>";
                        echo "<p>Phone: " . $row["phone"]. "</p>";
                        echo "<p>Room Type: " . $row["room_type"]. "</p>";
                        echo "<p>Check-in Date: " . $row["check_in"]. "</p>";
                        echo "<p>Check-out Date: " . $row["check_out"]. "</p>";
                    }
                } else {
                    echo "<p>No reservation found.</p>";
                }
                $conn->close();
                ?>
                <button onclick="printReservation()">Print Reservation</button>
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
