<?php
$servername = "localhost";
$username = "j_hamad83";
$password = "afpc1967";
$dbname = "jamel";

$dbsours = "mysql:host=$servername;dbname=$dbname";
$option = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $dbs = new PDO($dbsours, $username, $password, $option);
    // Uncomment the following line for debugging purposes only.
     echo " sehr gut Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
