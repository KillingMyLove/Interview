<?php

require_once __DIR__."/comment.php";
require_once __DIR__."/helpers.php";
$pdo = getPDO();
$comment = new Comment($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)){
    $username = htmlspecialchars($_POST['username']) ;
    $text = htmlspecialchars($_POST['comment']) ;

    $comment->addComment($username, $text);

    redirect("/../index.php");
}
else{
    redirect("/../index.php");
}