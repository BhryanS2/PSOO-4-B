<?php
class LoginService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}
	public function verifyPassword($userPassword, $password)
	{
		// valide md5 hash
		$passwordCrypt = md5($password);
		if ($passwordCrypt == $userPassword) {
			return true;
		}
		return false;
	}

	public function execute($email, $password)
	{
		$response = array();
		$sql = "SELECT * FROM users WHERE email = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		if (count($result) > 0) {
			$user = $result[0];
			$userPassword = $user["password"];
			if ($this->verifyPassword($userPassword, $password)) {
				$response["status"] = true;
				$response["message"] = "Login success";
				$userNoPassword = [
					"id" => $user["id"],
					"name" => $user["name"],
					"email" => $user["email"],
					"role" => $user["role"],
				];
				$response["data"] = $userNoPassword;
				return $response;
			}
			$response["status"] = false;
			$response["message"] = "Login failed";
			return $response;
		}
		$response["status"] = false;
		$response["message"] = "Login failed";
		return $response;
	}
}
