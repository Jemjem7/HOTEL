<!-- php -->

<?php
include 'components/connect.php';

session_start();

// Admin authentication
if (!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
    exit;
}

// Fetch all bookings
$bookings = $conn->query("SELECT * FROM `bookings` ORDER BY `check_in` ASC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch all messages
$messages = $conn->query("SELECT * FROM `messages` ORDER BY `id` DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- php -->





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <a href="admin_logout.php" class="btn">Logout</a>
    </header>
    <section class="content">
        <h2>Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Rooms</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= $booking['booking_id']; ?></td>
                    <td><?= $booking['name']; ?></td>
                    <td><?= $booking['email']; ?></td>
                    <td><?= $booking['rooms']; ?></td>
                    <td><?= $booking['check_in']; ?></td>
                    <td><?= $booking['check_out']; ?></td>
                    <td>
                        <a href="delete_booking.php?id=<?= $booking['booking_id']; ?>" class="btn delete">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <h2>Messages</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?= $message['id']; ?></td>
                    <td><?= $message['name']; ?></td>
                    <td><?= $message['email']; ?></td>
                    <td><?= $message['message']; ?></td>
                    <td>
                        <a href="delete_message.php?id=<?= $message['id']; ?>" class="btn delete">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
