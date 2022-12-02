<?php
class LoginService
{
	public function __construct()
	{
		require "connection.php";
		$this->conn = $conn;
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
		$reponse = array();
		$sql = "SELECT * FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":email", $email);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if (count($result) > 0) {
			$user = $result[0];
			$userPassword = $user["password"];
			if ($this->verifyPassword($userPassword, $password)) {
				$reponse["status"] = true;
				$reponse["message"] = "Login success";
				$userNoPassword = [
					"id" => $user["id"],
					"name" => $user["name"],
					"email" => $user["email"]
				];
				$reponse["data"] = $userNoPassword;
				return $reponse;
			}
			$response["status"] = false;
			$response["message"] = "Login failed";
			return $response;
		}
		$reponse["status"] = false;
		$reponse["message"] = "Login failed";
		return $reponse;
	}
}
