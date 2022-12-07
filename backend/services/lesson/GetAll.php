<?php
class GetAllLessonService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}
	public function execute()
	{
		$response = array();
		$sql = "SELECT id, name, description FROM lesson";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		$response["status"] = false;
		$response["message"] = "Get all lessons failed";
		if (count($result) > 0) {
			$response["status"] = true;
			$response["message"] = "Get all lessons success";
			$response["data"] = $result;
		}
		return $response;
	}
}
