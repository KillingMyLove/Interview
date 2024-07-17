<?php
require_once __DIR__."/helpers.php";

class Comment{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo=$pdo;
    }


    public function getAllComments(){
        try {
            $stmt = $this->pdo->query("SELECT * FROM comment ORDER BY created_at");
            return $stmt->fetchall();
        } catch (PDOException $e){
            $e->getMessage();
        }

    }

    public function addComment($username, $comment){
        try {
            $query = "INSERT INTO `comment` (name, text) VALUES (:name, :text)";
            $params = [
                'name' => $username,
                'text' => $comment
            ];
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            $e->getMessage();
        }

    }

    public function getComment($id){
        $stmt = $this->pdo->prepare("SELECT * FROM comment WHERE `id` = :id");
        $stmt->execute(['id'=> $id]);
       return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function editComment($id, $username, $comment){
        try {
            $stmt = $this->pdo->prepare("UPDATE comment SET name=:name, text=:text WHERE id = :id");
            $params = [
                'name' => $username,
                'text' => $comment,
                'id' => $id
            ];
            $stmt->execute($params);
        } catch (PDOException $e){
            $e->getMessage();
        }
    }

    public function deleteComment($id){
        try {
            $stmt = $this->pdo->prepare("DELETE FROM comment WHERE id = :id");
            $params = [
                'id' => $id
            ];
            $stmt->execute($params);
        } catch (PDOException $e){
            $e->getMessage();
        }
    }
}

$pdo = getPDO();

$comment = new Comment($pdo);

$comments = $comment->getAllComments();