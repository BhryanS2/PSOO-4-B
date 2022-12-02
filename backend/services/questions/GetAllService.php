<?php
class GetAllQuestionsService
{
	public function __construct()
	{
		require "connection.php";
		$this->conn = $conn;
	}

	private function prepareSQL($sql)
	{
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
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

	public function execute($filters = [])
	{
		$response = array();
		$sql = "SELECT questions.id,
    questions.content,
    questions.lesson_id,
    questions.created_at,
    questions.updated_at,
		questions.explanation,
    alternatives.content as alternative_content,
    alternatives.isCorrect,
    alternatives.id as alternative_id
    FROM questions INNER JOIN alternatives ON questions.id = alternatives.question_id";
		$result = $this->prepareSQL($sql);
		$questions = $this->toJSON($result);
		if (count($filters) > 0) {
			$questions = $this->filter_questions($questions, $filters);
		}
		$response['status'] = false;
		$response['message'] = "Get all questions failed";

		if (count($questions) > 0) {
			$response['status'] = true;
			$response['message'] = "Get all questions success";
			$response['data'] = $questions;
		}

		return $response;
	}
}
