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
		$sql = "SELECT * FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":email", $email);
		$stmt->execute();
		$result = $stmt->fetchAll();
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
		$sql = "INSERT INTO users (email, password, name) VALUES (:email, :password, :name)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":password", $hash);
		$stmt->bindParam(":name", $name);
		$stmt->execute();

		$response["status"] = true;
		$response["message"] = "Register success";
		return $response;
	}
}
