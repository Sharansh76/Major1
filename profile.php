<?php
session_start();
include 'dbconnect.php'; // Database connection file
// Check if user is logged in
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}
// Fetch user details
$patient_id = $_SESSION['patient_id'];
$query = "SELECT * FROM patients1 WHERE patient_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
 
?>

    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
    <a href="logout.php">Logout</a>
