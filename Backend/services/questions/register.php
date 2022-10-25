<?php
class RegisterQuestionService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute($content, $userId, $lessonId, $tags)
  {
    $reponse = array();
    $sql = "INSERT INTO questions (content, userId, lessonId) VALUES (:content, :userId, :lessonId)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":lessonId", $lessonId);
    $stmt->execute();
    $reponse["status"] = false;
    $reponse["message"] = "Register failed";
    if ($stmt->rowCount() > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Register success";
      $reponse["data"] = array(
        "id" => $this->conn->lastInsertId(),
        "content" => $content,
        "userId" => $userId,
        "lessonId" => $lessonId,
        "tags" => $tags
      );
    }
    echo json_encode($reponse);
    return;
  }
}
