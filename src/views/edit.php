<?php
require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['id'])) {
    $questionId = $_GET['id'];
    $query = "SELECT * FROM questions WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $questionId);
    $stmt->execute();
    $question = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];

    $updateQuery = "UPDATE questions SET title = :title, body = :body WHERE id = :id";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bindParam(':title', $title);
    $updateStmt->bindParam(':body', $body);
    $updateStmt->bindParam(':id', $questionId);
    
    if ($updateStmt->execute()) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <title>Edit Question</title>
</head>
<body>
    <div class="container">
        <h2>Edit Question</h2>
        <form method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($question['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="5" required><?php echo htmlspecialchars($question['body']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Question</button>
        </form>
    </div>
    <script src="../public/js/bootstrap.min.js"></script>
</body>
</html>