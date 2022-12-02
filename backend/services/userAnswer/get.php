<?php
class GetAnswerService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}

	public function execute($id)
	{
		$response = array();
		$sql = "SELECT * FROM answers WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$response['status'] = true;
		$response['message'] = "Get answer success";
		$response['data'] = $result;

		return $response;
	}
}
