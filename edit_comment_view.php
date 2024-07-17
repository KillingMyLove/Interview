<?php
require_once __DIR__."/src/comment.php";
require_once __DIR__."/src/helpers.php";

$pdo = getPDO();
$comment = new Comment($pdo);

$id = $_GET['id'];

if (!isset($id)){
    redirect("/index.php");
}

$commentData = $comment->getComment($id);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Изменить комментарий</h1>

    <form method="POST" action="src/edit_comment.php">
        <div class="mb-3">
            <input type="text" hidden="hidden" name="id" value="<?php echo $_GET['id']?>"
            <label for="username" class="form-label">Пользователь</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($commentData['name'] ?? '')?>" required>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Комментарий</label>
            <textarea class="form-control" name="comment" rows="3" required><?php echo htmlspecialchars($commentData['text'] ?? '')?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>