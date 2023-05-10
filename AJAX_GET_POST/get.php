<?php
// Replace with your own database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbperson";

// Create a new MySQLi object
$db = new mysqli($servername, $username, $password, $dbname);

// Retrieve users
$sql = "SELECT * FROM person";
$result = $db->query($sql);

// Convert result set to array
$users = array();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Return JSON-encoded array of users
echo json_encode($users);

?>
