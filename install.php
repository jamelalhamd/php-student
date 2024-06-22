<?php
global $dbs;
require_once('config.php');

// SQL statement to create the table
$sql = "CREATE TABLE IF NOT EXISTS student (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    text VARCHAR(250) NOT NULL
)";

try {
    // Execute the SQL statement
    $dbs->exec($sql);
    echo "Table student created successfully";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

// No need to close the connection manually as it will be closed automatically at the end of the script
?>
