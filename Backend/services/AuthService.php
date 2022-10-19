<?php
class AuthService
{
	public function __construct()
	{
		require "../connection.php";
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

	public function login($email, $password)
	{
		$reponse = array();
		$sql = "SELECT * FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":email", $email);
		$stmt->execute();
		$result = $stmt->fetchAll();
		// echo json_encode($result);
		if (count($result) > 0) {
			$userPassword = $result[0]["password"];
			if ($this->verifyPassword($userPassword, $password)) {
				$reponse["status"] = true;
				$reponse["message"] = "Login success";
				$reponse["data"] = $result[0];
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
