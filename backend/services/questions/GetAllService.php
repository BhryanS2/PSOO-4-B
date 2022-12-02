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


		$sql = "SELECT * FROM `questions`";

		$stmt = $this->conn->prepare($sql);
		$result = $stmt->execute();

		if (!$result) {
			$response['error'] = $this->conn->error;
			return $response;
		}

		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);

		$response['sql'] = $sql;
		$response['result'] = $result;


		return $response;

		$questions = $this->toJSON($result);

		if (count($data) > 0) {
			$questions = $this->filter_questions($questions, $data);
		}
		if (count($questions) > 0) {
			$response['status'] = true;
			$response['message'] = "Get all questions success";
			$response['data'] = $questions;
		}
	}
}
