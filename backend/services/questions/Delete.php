<?php
class DeleteQuestionService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}
	public function execute($id)
	{
		$response = array();
		$sql = "DELETE FROM questions WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$response["status"] = false;
		$response["message"] = "Delete question failed";

		if ($stmt->error) {
			$response["message"] = $stmt->error;
		}

		if ($stmt->num_rows > 0) {
			$response["status"] = true;
			$response["message"] = "Delete question success";
		}

		return $response;
	}
}
