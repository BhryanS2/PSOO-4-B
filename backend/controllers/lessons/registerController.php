<?php
class RegisterLessonController
{
	public function __construct()
	{
		require_once "services/lesson/register.php";
	}
	public function handle(array $data)
	{
		$name = isset($data['name']) ? $data['name'] : null;
		$description = isset($data['description']) ? $data['description'] : null;

		if ($name === null || $description === null) {
			$fieldsRequired = array();
			if ($name == null) {
				array_push($fieldsRequired, "name");
			}
			if ($description == null) {
				array_push($fieldsRequired, "description");
			}

			return array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired);
		}
		$service = new RegisterLessonService();
		$result = $service->execute($name, $description);
		return $result;
	}
}
