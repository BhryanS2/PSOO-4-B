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
		$sql = "SELECT * FROM answers WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();

		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		$response['status'] = true;
		$response['message'] = "Get answer success";
		$response['data'] = $result;

		return $response;
	}
}
