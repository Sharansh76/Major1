
<?php
$host = 'localhost';  // Database host
$username = 'root';   // Database username
$password = '';       // Database password
$database = 'boosttech'; // Your database name

// Create connection
$mysqli = new mysqli($host, $username, $password, $database);
$conn = $mysqli;
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>
