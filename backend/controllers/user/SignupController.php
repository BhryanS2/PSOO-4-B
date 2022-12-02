<?php
class SignupController
{
	public function __construct()
	{
		require_once "services/user/Singnup.php";
	}
	public function handle(array $data)
	{
		$email = isset($data['email']) ? $data['email'] : null;
		$password = isset($data['password']) ? $data['password'] : null;
		$name = isset($data['name']) ? $data['name'] : null;

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

			return array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired);
		}

		$service = new SingupService();
		$result = $service->execute($email, $password, $name);
		return $result;
	}
}
