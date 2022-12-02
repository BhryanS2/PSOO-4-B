<?php
class GetAllQuestionsService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}

	private function toJSON($result)
	{
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
					"explanation" => $row['explanation'],
					"alternatives" => array()
				);
			}
			array_push($questions[$questionId]['alternatives'], array(
				"content" => $row['alternative_content'],
				"isCorrect" => $row['isCorrect'],
				"id" => $row['alternative_id']
			));
		}
		return array_values($questions);
	}

	private function filter_questions($questions, $filters)
	{
		$filtered_questions = array();
		foreach ($questions as $question) {
			$add = true;
			foreach ($filters as $key => $value) {
				if ($question[$key] != $value) {
					$add = false;
					break;
				}
			}
			if ($add) {
				array_push($filtered_questions, $question);
			}
		}
		return $filtered_questions;
	}

	public function execute(array $data)
	{

		$response = array(
			"status" => false,
			"message" => "Get all questions failed"
		);


		$sql = "SELECT questions.id,
    questions.content,
    questions.lesson_id,
    questions.created_at,
    questions.updated_at,
		questions.explanation,
    alternatives.content as alternative_content,
    alternatives.isCorrect,
    alternatives.id as alternative_id
    FROM questions
		INNER JOIN alternatives ON questions.id = alternatives.question_id";
		echo "sql: $sql <br>";
		$stmt = $this->conn->prepare($sql);
		$result = $stmt->execute();

		if (!$result) {
			$response['error'] = $this->conn->error;
			return $response;
		}


		$result = $stmt->get_result();
		echo "result: $result <br>";

		if (!$result) {
			$response['error'] = $this->conn->error;
			return $response;
		}

		$result = $result->fetch_all(MYSQLI_ASSOC);
		print_r($result);
		echo "<br>";

		if (count($result) <= 0) {
			$response['message'] = "No questions found";
			return $response;
		}

		$questions = $this->toJSON($result);
		echo "questions: ";
		print_r($questions);
		echo "<br>";
		if (count($data) > 0) {
			$questions = $this->filter_questions($questions, $data);
		}

		$response['status'] = true;
		$response['message'] = "Get all questions success";
		$response['data'] = $questions;
		return $response;
	}
}
