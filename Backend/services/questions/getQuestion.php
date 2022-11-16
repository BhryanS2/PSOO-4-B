<?php
class GetQuestionService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute($id)
  {
    $reponse = array();
    $sql = "SELECT questions.id, questions.content, questions.lesson_id, , questions.created_at, questions.updated_at, alternatives.content as alternative_content, alternatives.isCorrect FROM questions INNER JOIN alternatives ON questions.id = alternatives.question_id
    where questions.id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $alternatives = array();
    foreach ($result as $row) {
      array_push($alternatives, array(
        "content" => $row['alternative_content'],
        "isCorrect" => $row['isCorrect']
      ));
    }
    // print_r($result);
    $questionData = $result[0];
    $question = array(
      "id" => $questionData['id'],
      "content" => $questionData['content'],
      "lessonId" => $questionData['lesson_id'],
      "userId" => $questionData['user_id'],
      "createdAt" => $questionData['created_at'],
      "updatedAt" => $questionData['updated_at'],
      "alternatives" => $alternatives
    );
    $reponse['status'] = true;
    $reponse['message'] = "Get question success";
    $reponse['data'] = $question;

    return $reponse;
  }
}
