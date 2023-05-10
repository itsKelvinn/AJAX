<?php

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$email = $data['email'];

// Replace with your own database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbperson";

// Create a new MySQLi object
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO person (person_name, person_email) VALUES (?, ?)");

// Bind parameters
$stmt->bind_param("ss", $name, $email);

// Set parameters and execute the statement
$stmt->execute();

// Close the statement and database connection
$stmt->close();
$conn->close();


?>
