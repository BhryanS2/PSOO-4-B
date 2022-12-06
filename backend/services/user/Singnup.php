<?php
class SingupService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}
	public function existsUser($email)
	{
		$sql = "SELECT * FROM users WHERE email = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		if (count($result) > 0) {
			return true;
		}
		return false;
	}

	public function execute($email, $password, $name)
	{
		if ($this->existsUser($email)) {
			return array("status" => false, "message" => "User already exists");
		}
		$hash = md5($password);
		$sql = "INSERT INTO users (email, password, name) VALUES (?, ?, ?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sss", $email, $hash, $name);
		$stmt->execute();

		$response["status"] = true;
		$response["message"] = "Register success";
		return $response;
	}
}
