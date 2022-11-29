<?php
class LoginController
{
	public function __construct()
	{
		require "services/user/Login.php";
	}
	public function handle()
	{

		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		$email = isset($data['email']) ? $data['email'] : null;
		$password = isset($data['password']) ? $data['password'] : null;

		if ($email === null || $password === null) {
			$fieldsRequired = array();
			if ($email == null) {
				array_push($fieldsRequired, "email");
			}
			if ($password == null) {
				array_push($fieldsRequired, "password");
			}

			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Login failed", "fieldsRequired" => $fieldsRequired));
			return json_encode(array("status" => false, "message" => "Login failed", "fieldsRequired" => $fieldsRequired));
		}
		$service = new LoginService();
		$result = $service->execute($email, $password);
		echo json_encode($result);
		return json_encode($result);
		return json_encode($result);
	}
}
