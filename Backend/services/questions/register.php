<?php
class RegisterQuestionService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute($content, $userId, $lessonId, $alternatives)
  {
    $reponse = array();
    /*
    $alternatives = [
      [
        "content" => "alternativa 1",
        "isCorrect" => true
      ],
      [
        "content" => "alternativa 2",
        "isCorrect" => false
      ],
      [
        "content" => "alternativa 3",
        "isCorrect" => false
      ],
      [
        "content" => "alternativa 4",
        "isCorrect" => false
      ]
    ];
    */
    $sql = "INSERT INTO questions (content, user_id, lesson_id) VALUES (:content, :user_id, :lesson_id)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":lesson_id", $lessonId);
    $stmt->execute();
    $questionId = $this->conn->lastInsertId();
    $sql = "INSERT INTO alternatives (content, isCorrect, question_id) VALUES (:content, :isCorrect, :question_id)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":question_id", $questionId);
    foreach ($alternatives as $alternative) {
      $content = $alternative['content'];
      $isCorrect = $alternative['isCorrect'];
      $stmt->bindParam(":content", $content);
      $stmt->bindParam(":isCorrect", $isCorrect);
      $stmt->execute();
    }
    $reponse['status'] = true;
    $reponse['message'] = "Register success";
    $response['data'] = array(
      "questionId" => $questionId,
      "content" => $content,
      "lessonId" => $lessonId,
    );
    return $reponse;
  }
}
