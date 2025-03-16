<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Q&A</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Questions</h1>
        <a href="create.php" class="btn btn-primary mb-3">Create New Question</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the QuestionController to fetch questions
                require_once '../controllers/QuestionController.php';
                $controller = new QuestionController();
                $questions = $controller->read();

                foreach ($questions as $question) {
                    echo "<tr>
                            <td>{$question['id']}</td>
                            <td>{$question['title']}</td>
                            <td>
                                <a href='show.php?id={$question['id']}' class='btn btn-info'>View</a>
                                <a href='edit.php?id={$question['id']}' class='btn btn-warning'>Edit</a>
                                <a href='delete.php?id={$question['id']}' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../public/js/bootstrap.min.js"></script>
</body>
</html>