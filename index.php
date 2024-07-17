<?php
require_once __DIR__."/src/students.php";
require_once __DIR__."/src/helpers.php";
require_once __DIR__."/src/comment.php";
require_once  __DIR__."/magic_text.php";


//print_r($comments);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовые задания</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1>Задание 1:</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col">Математика</th>
        <th scope="col">ОБЖ</th>
        <th scope="col">Физика</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($newData as $name => $subjects): ?>
    <tr>
        <th scope="row"><?php echo $name?></th>
        <?php arsort($subjects) ?>
        <td><?php echo isset($subjects['Математика']) ? $subjects['Математика'] : ''?></td>
        <td><?php echo isset($subjects['ОБЖ']) ? $subjects['ОБЖ'] : ''?></td>
        <td><?php echo isset($subjects['Физика']) ? $subjects['Физика'] : ''?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h1>Задание 2:</h1>

<p>-- Удаление пустых групп (без товаров)
    <br>
    DELETE FROM categories
    WHERE NOT EXISTS (
    SELECT 1 FROM products WHERE products.category_id = categories.id
    );
    <br>
    -- Удаление товаров без наличия
    <br>
    DELETE FROM products
    WHERE NOT EXISTS (
    SELECT 1 FROM availabilities WHERE availabilities.product_id = products.id
    );
    <br>
    -- Удаление складов без товаров
    <br>
    DELETE FROM stocks
    WHERE NOT EXISTS (
    SELECT 1 FROM availabilities WHERE availabilities.stock_id = stocks.id
    );
    <br> <b>//В подзапросах возвращаются строки которые связаны по idшниками, если у нас не вернулась хотя бы одна строка, то удаляем категорию/товар/склад</b>
</p>

<h1>Задание 3:</h1>
<div class="container mt-5">
    <h1>Комментарии</h1>
    <div class="mb-4">
        <a class="btn btn-primary" href="add_comment_view.php" role="button">Добавить новый комментарий.</a>
    </div>

    <div class="mb-4">
        <h2>Список комментариев:</h2>
        <?php if(!empty($comments)):?>
        <ul class="list-group">
            <?php foreach ($comments as $comment): ?>
            <li class="list-group-item">
                <strong><?php echo htmlspecialchars($comment['name'] ?? '')?></strong><br>
                <?php echo nl2br(htmlspecialchars($comment['text']) ?? '') ?><br>
                <small class="text-muted"><?php echo $comment['created_at']?></small><br>
                <a href="edit_comment_view.php?id=<?php echo $comment['id']?>" class="btn btn-secondary btn-sm">Изменить</a>
                <a href="src/delete_comment.php?id=<?php echo $comment['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить?')">Удалить</a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>Ещё нет комментариев.</p>
        <?php endif;?>
    </div>
</div>

<h1>Задание 4:</h1>
<?php
echo $newText;
?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
