<?php

require_once __DIR__."/comment.php";
require_once __DIR__."/helpers.php";

$pdo = getPDO();
$comment = new Comment($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)){
    $id = htmlspecialchars($_POST['id']);
    $username = htmlspecialchars($_POST['username']);
    $text = htmlspecialchars($_POST['comment']);

    $comment->editComment($id, $username, $text);

    redirect("/../index.php");
}
else{
    redirect("/../index.php");
}