<?php
class DeleteLessonService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}
	public function execute($id)
	{
		$response = array();
		$sql = "DELETE FROM lesson WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$response["status"] = false;
		$response["message"] = "Delete lesson failed";
		if ($stmt->num_rows() > 0) {
			$response["status"] = true;
			$response["message"] = "Delete lesson success";
		}
		return $response;
	}
}
