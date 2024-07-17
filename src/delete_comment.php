<?php

require_once __DIR__."/comment.php";
require_once __DIR__."/helpers.php";

$pdo = getPDO();
$comment = new Comment($pdo);

$id = $_GET['id'];
$comment->deleteComment($id);

redirect("/../index.php");
