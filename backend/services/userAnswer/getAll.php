<?php
class GetAllAnswersService
{

	public function __construct()
	{
		require_once "connection.php";
		$this->conn = $conn;
	}

	public function execute()
	{
		$result = array();
		$sql = "SELECT * FROM answers";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$response['status'] = true;
		$response['message'] = "Get all answers success";
		$response['data'] = $result;
		return $response;
	}
}
