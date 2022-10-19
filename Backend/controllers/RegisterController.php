<?php
class RegisterController
{
	public function __construct()
	{
		require "../services/RegisterService.php";
	}
	public function handle()
	{
		// Get data from http request
		// echo json_encode($_SERVER);

		$email = isset($_POST['email']) ? $_POST['email'] : null;
		$password = isset($_POST['password']) ? $_POST['password'] : null;
		$name = isset($_POST['name']) ? $_POST['name'] : null;
		$userType = isset($_POST['userType']) ? $_POST['userType'] : null;

		if ($email == null || $password == null || $name == null) {
			$fieldsRequired = array();
			if ($email == null) {
				array_push($fieldsRequired, "email");
			}
			if ($password == null) {
				array_push($fieldsRequired, "password");
			}
			if ($name == null) {
				array_push($fieldsRequired, "name");
			}
			echo json_encode(array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired));
			return;
		}

		$registerService = new RegisterService();
		$result = $registerService->execute($email, $password, $name);
		echo json_encode($result);
		return;
	}
}

$registerController = new RegisterController();
$registerController->handle();
