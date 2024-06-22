<?php
global $dbs;
require_once('config.php');

$page_title = 'Update an idea';
$page_heading = 'Idea Updating';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
</head>

<body>
<h1><?php echo $page_heading; ?></h1>
<p><a href="index.php">Go back to the homepage</a></p>

<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['title']) && isset($_POST['text']) && isset($_POST['id'])) {
        $idea_title = $_POST['title'];
        $idea_text = $_POST['text'];
        $id = $_POST['id'];

        // Prepare the update statement
        $sql = "UPDATE `student` SET `title` = :title, `text` = :text WHERE id = :id";
        $statement = $dbs->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':title', $idea_title, PDO::PARAM_STR);
        $statement->bindParam(':text', $idea_text, PDO::PARAM_STR);
        $success = $statement->execute();

        if ($success) {
            echo "<div style='background:green;color:white;padding:10px;'>
                        <p>Your idea has been updated successfully.</p>
                      </div>";
        } else {
            echo "<div style='background:red;color:white;padding:10px;'>
                        <p>Failed to update your idea. Please try again.</p>
                      </div>";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlselect = "SELECT * FROM `student` WHERE id =:id";
    $data = $dbs->prepare($sqlselect);
    $data->bindParam(':id', $id, PDO::PARAM_INT);

   $sucess= $data->execute();
    $result = $data->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        ?>
        <div style="background:#eee;padding:10px;">
            <p>You are updating the idea #<?php echo htmlspecialchars($id, ENT_QUOTES); ?></p>
        </div>
        <br>
        <hr>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>">
            <label for="title">Idea Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($result['title'], ENT_QUOTES); ?>">
            <br><br>
            <label for="text">Idea Text</label>
            <textarea name="text" rows="8" cols="80"><?php echo htmlspecialchars($result['text'], ENT_QUOTES); ?></textarea>
            <br><br>
            <input type="submit" name="submit" value="Save your idea">
        </form>
        <hr>
        <br>
        <?php
    } else {
        echo "<div style='background:red;color:white;padding:10px;'>
                    <p>No idea found with ID " . htmlspecialchars($id, ENT_QUOTES) . ".</p>
                  </div>";
    }
}
?>
</body>

</html>
