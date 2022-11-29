<?php
class GetAllQuestionsService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute($filters = [])
  {
    $response = array();
    $sql = "SELECT questions.id,
    questions.content,
    questions.lesson_id,
    questions.created_at,
    questions.updated_at,
    alternatives.content as alternative_content,
    alternatives.isCorrect,
    alternatives.id as alternative_id
    FROM questions INNER JOIN alternatives ON questions.id = alternatives.question_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $questions = array();
    foreach ($result as $row) {
      $questionId = $row['id'];
      if (!isset($questions[$questionId])) {
        $questions[$questionId] = array(
          "id" => $row['id'],
          "content" => $row['content'],
          "lessonId" => $row['lesson_id'],
          "createdAt" => $row['created_at'],
          "updatedAt" => $row['updated_at'],
          "alternatives" => array()
        );
      }
      array_push($questions[$questionId]['alternatives'], array(
        "content" => $row['alternative_content'],
        "isCorrect" => $row['isCorrect'],
        "id" => $row['alternative_id']
      ));
    }
    $questionsValues = array_values($questions);
    $questionsFltered = array();
    foreach ($questionsValues as $question) {
      $isFiltered = false;
      foreach ($filters as $key => $value) {
        if ($question[$key] != $value) {
          $isFiltered = true;
          break;
        }
      }
      if (!$isFiltered) {
        array_push($questionsFltered, $question);
      }
    }
    $response['status'] = true;
    $response['message'] = "Get all questions success";
    $response['data'] = $questionsFltered;

    return $response;
  }
}
