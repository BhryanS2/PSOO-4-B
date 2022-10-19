<?php
class AuthController
{
	public function __construct()
	{
		require "../services/AuthService.php";
	}
	public function login()
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
			echo json_encode(array("status" => false, "message" => "Login failed", "fieldsRequired" => $fieldsRequired));
			return;
		}
		$authService = new AuthService();
		$result = $authService->login($email, $password);
		echo json_encode($result);
		return;
	}
}

$authController = new AuthController();
$authController->login();
