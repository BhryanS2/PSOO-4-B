<?php
class GetQuestionService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}
	public function execute($id)
	{
		$response = array();
		$sql = "SELECT questions.id,
		questions.content, questions.lesson_id,
		questions.explanation as explanation,
		questions.created_at,
		questions.updated_at,
		alternatives.content as alternative_content,
		alternatives.isCorrect
		FROM questions INNER JOIN alternatives ON questions.id = alternatives.question_id
    where questions.id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();

		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
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
			"createdAt" => $questionData['created_at'],
			'explanation' => $questionData['explanation'],
			"updatedAt" => $questionData['updated_at'],
			"alternatives" => $alternatives
		);
		$response['status'] = true;
		$response['message'] = "Get question success";
		$response['data'] = $question;

		return $response;
	}
}
