<?php
class RegisterLessonService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}

	public function execute($name, $description)
	{
		$response = array();
		$sql = "INSERT INTO lesson (name, description) VALUES (?, ?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("ss", $name, $description);
		$stmt->execute();

		$response["status"] = true;
		$response["message"] = "Register lesson success";

		return $response;
	}
}
