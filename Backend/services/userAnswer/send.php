<?php
class SendAnswerService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute($userId, $questionId, $alternativeId)
  {
    $result = array();
    $sql_get_question_correct = "SELECT 
    alternatives.isCorrect as correct,
    alternatives.id as alternative_id
    FROM questions 
    inner join alternatives on questions.id = alternatives.question_id 
    where questions.id = :question_id";

    $stmt_get_question_correct = $this->conn->prepare($sql_get_question_correct);
    $stmt_get_question_correct->bindParam(":question_id", $questionId);
    $stmt_get_question_correct->execute();
    $response_get_questions = $stmt_get_question_correct->fetchAll(PDO::FETCH_ASSOC);
    $isCorrect = false;
    $correctAlternativeId = null;
    foreach ($response_get_questions as $row) {
      if ($row['correct']) {
        $isCorrect = $alternativeId === $row['alternative_id'];
        $correctAlternativeId = $row['alternative_id'];
      }
    }

    $sql = "INSERT INTO 
      answers (user_id, question_id, alternative_id, correct) 
      VALUES (:user_id, :question_id, :alternative_id, :correct)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":question_id", $questionId);
    $stmt->bindParam(":alternative_id", $alternativeId);
    $stmt->bindParam(":correct", $isCorrect);
    $stmt->execute();
    $result['status'] = true;
    $result['message'] = "Send answer success";
    $result['data'] = array(
      "isCorrect" => strlen($isCorrect) > 0,
      "correctAlternativeId" => $correctAlternativeId
    );
    return $result;
  }
}
