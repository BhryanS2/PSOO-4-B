<?php
class GetAllAnswersService
{

	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}

	public function execute()
	{
		$result = array();
		$sql = "SELECT * FROM answers";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		$response['status'] = true;
		$response['message'] = "Get all answers success";
		$response['data'] = $result;
		return $response;
	}
}
