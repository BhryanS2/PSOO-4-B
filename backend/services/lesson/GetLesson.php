<?php
class GetLessonService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}
	public function execute($id)
	{
		$response = array();
		$sql = "SELECT * FROM lesson WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		$response["status"] = false;
		$response["message"] = "Get lesson failed";
		if ($result) {
			$response["status"] = true;
			$response["message"] = "Get lesson success";
			$response["data"] = $result;
		}
		return $response;
	}
}
