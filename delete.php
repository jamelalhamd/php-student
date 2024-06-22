<?php
global $dbs;
require_once('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete statement
    $sql = "DELETE FROM student WHERE id = :id";
    $stmt = $dbs->prepare($sql);

    // Bind the parameter and execute the statement
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Assuming id is an integer
    $success = $stmt->execute();

    // Check if any rows were affected
    if ($success ) {
        echo "<div style='background:green;color:white;padding:10px;'>The idea has been deleted successfully.</div>";
    } else {
        echo "<div style='background:red;color:white;padding:10px;'>Failed to delete the idea. Please try again.</div>";
    }
    header("Location: index.php");
    // Close the statement
    $stmt->close();

    // Redirect back to the homepage

    exit();
} else {
    echo "<div style='background:red;color:white;padding:10px;'>No ID provided.</div>";
}

// Close the database connection
$dbs = null;
?>
