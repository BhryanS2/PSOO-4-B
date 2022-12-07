<?php
class DeleteService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}
	public function execute($id)
	{
		$sql = "DELETE FROM users WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$response["status"] = true;
		$response["message"] = "Delete success";
		return $response;
	}
}
