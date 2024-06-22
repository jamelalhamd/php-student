<?php
global $dbs;
$page_title = 'Add your idea';
$page_heading = 'Share your idea with us';
require_once('config.php');

// Insert a new idea if the form is submitted
if (isset($_POST['submit'])) {
    if (isset($_POST['title']) && isset($_POST['text'])) {
        $idea_title = $_POST['title'];
        $idea_text = $_POST['text'];

        $sql = "INSERT INTO student (title, text) VALUES (:title, :text)";
        $stmt = $dbs->prepare($sql);
        $stmt->bindParam(':title', $idea_title, PDO::PARAM_STR);
        $stmt->bindParam(':text', $idea_text, PDO::PARAM_STR);
        if ($stmt->execute()) {
            echo "<div style='background:green;color:white;padding:10px;'>Your idea was added successfully:</div>";
            echo "<p>Your idea title: " . htmlspecialchars($idea_title, ENT_QUOTES) . "</p>";
            echo "<p>Your idea text: " . htmlspecialchars($idea_text, ENT_QUOTES) . "</p>";
        } else {
            echo "<div style='background:red;color:white;padding:10px;'>Failed to add your idea. Please try again.</div>";
        }
    }
}

// Fetch all ideas from the database
$sql = "SELECT * FROM student";

$result = $dbs->query($sql);
$data=$result->fetchAll();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
    <style>
        table,
        th,
        td {
            border: 1px solid;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
<h1><?php echo $page_heading; ?></h1>

<form action="" method="POST">
    <label for="title">Idea Title</label>
    <input type="text" name="title" value="<?php if (isset($_POST['title'])) { echo htmlspecialchars($_POST['title'], ENT_QUOTES); } ?>">
    <br><br>
    <label for="text">Idea Text</label>
    <textarea name="text" rows="8" cols="80"><?php if (isset($_POST['text'])) { echo htmlspecialchars($_POST['text'], ENT_QUOTES); } ?></textarea>
    <br><br>
    <input type="submit" name="submit" value="Save your idea">
</form>

<hr><hr><br>

<table style="width:100%;background:#eee;text-align:center">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Text</th>
        <th>Delete</th>
    </tr>
    <?php if ($result->rowCount() > 0): ?>
        <?php foreach($data as $row): ?>
            <tr>
                <th><a href="update.php?id=<?php echo $row['id']; ?>">#<?php echo $row['id']; ?></a></th>
                <th><?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?></th>
                <th><?php echo htmlspecialchars($row['text'], ENT_QUOTES); ?></th>
                <th><a href="delete.php?id=<?php echo $row['id']; ?>" style="color:red;">X</a></th>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">No ideas found.</td>
        </tr>
    <?php endif; ?>
</table>

</body>

</html>

<?php
// Close the database connection
$connection = null;
?>
