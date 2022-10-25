<?php
class LoginController
{
	public function __construct()
	{
		require "services/user/Login.php";
	}
	public function handle()
	{
		$email = isset($_POST['email']) ? $_POST['email'] : null;
		$password = isset($_POST['password']) ? $_POST['password'] : null;

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
			return;
		}
		$service = new LoginService();
		$result = $service->execute($email, $password);
		echo json_encode($result);
		return;
	}
}
