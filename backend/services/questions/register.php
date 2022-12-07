<?php
class RegisterQuestionService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}

	public function execute($content, $lessonId, $alternatives)
	{
		$response = array();
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
		$sql = "INSERT INTO questions (content, lesson_id) VALUES (?,?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("si", $content, $lessonId);
		$stmt->execute();

		$questionId = $this->conn->insert_id;
		$sql = "INSERT INTO alternatives (content, isCorrect, question_id) VALUES (?, ?, ?)";

		foreach ($alternatives as $alternative) {
			$content = $alternative['content'];
			$isCorrect = $alternative['isCorrect'];
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sii", $content, $isCorrect, $questionId);
			$stmt->execute();
		}
		$response['status'] = true;
		$response['message'] = "Register success";
		$response['data'] = array(
			"questionId" => $questionId,
			"content" => $content,
			"lessonId" => $lessonId,
		);
		return $response;
	}
}
