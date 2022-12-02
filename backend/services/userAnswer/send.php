<?php
class SendAnswerService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}

	public function execute($userId, $questionId, $alternativeId)
	{
		$result = array(
			"status" => false,
			"message" => "Send answer failed"
		);

		$sql_get_question_correct = "SELECT
    alternatives.isCorrect as correct,
    alternatives.id as alternative_id
    FROM questions
    inner join alternatives on questions.id = alternatives.question_id
    where questions.id = ?";

		$stmt = $this->conn->prepare($sql_get_question_correct);
		$stmt->bind_param("i", $questionId);
		$stmt->execute();
		$result = $stmt->get_result();
		$response_get_questions = $result->fetch_all(MYSQLI_ASSOC);

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
      VALUES (?, ?, ?, ?)";

		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("iiii", $userId, $questionId, $correctAlternativeId, $isCorrect);
		$result = $stmt->execute();

		$response = array(
			"status" => false,
			"message" => "Send answer failed"
		);

		if (!$result) {
			$response['error'] = $this->conn->error;
			return $response;
		}

		$response['status'] = true;
		$response['message'] = "Send answer success";
		$response['data'] = array(
			"correct" => strlen($isCorrect) > 0,
			"correctAlternativeId" => $correctAlternativeId
		);

		return $response;
	}
}
