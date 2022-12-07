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
		$reponse = array();
		$sql = "SELECT * FROM users WHERE email = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("s", $email);
		$response['sql'] = $sql;
		// $stmt->execute();
		// $result = $stmt->get_result();
		// $result = $result->fetch_all(MYSQLI_ASSOC);
		// if (count($result) > 0) {
		// 	$user = $result[0];
		// 	$userPassword = $user["password"];
		// 	if ($this->verifyPassword($userPassword, $password)) {
		// 		$reponse["status"] = true;
		// 		$reponse["message"] = "Login success";
		// 		$userNoPassword = [
		// 			"id" => $user["id"],
		// 			"name" => $user["name"],
		// 			"email" => $user["email"],
		// 			"role" => $user["role"],
		// 		];
		// 		$reponse["data"] = $userNoPassword;
		// 		return $reponse;
		// 	}
		// 	$response["status"] = false;
		// 	$response["message"] = "Login failed";
		// 	return $response;
		// }
		// $reponse["status"] = false;
		// $reponse["message"] = "Login failed";
		return $reponse;
	}
}
