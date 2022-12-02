<?php
class LoginController
{
	public function __construct()
	{
		require "services/user/Login.php";
	}
	public function handle(array $data)
	{
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
			return array("status" => false, "message" => "Login failed", "fieldsRequired" => $fieldsRequired);
		}
		$service = new LoginService();
		$result = $service->execute($email, $password);
		return $result;
	}
}
