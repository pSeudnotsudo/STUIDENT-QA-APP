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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <title>Question Details</title>
</head>
<body>
    <div class="container mt-5">
        <?php if ($question): ?>
            <h1><?php echo htmlspecialchars($question['title']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($question['body'])); ?></p>
            <a href="edit.php?id=<?php echo $question['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="index.php" class="btn btn-secondary">Back to Questions</a>
        <?php else: ?>
            <h2>Question not found.</h2>
            <a href="index.php" class="btn btn-secondary">Back to Questions</a>
        <?php endif; ?>
    </div>
    <script src="../public/js/bootstrap.min.js"></script>
</body>
</html>