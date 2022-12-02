<?php
class DeleteUserController
{
	public function __construct()
	{
		require_once "services/user/Delete.php";
	}
	public function handle(array $data)
	{
		$id = isset($data['id']) ? $data['id'] : null;
		if (!$id) {
			return array("status" => false, "message" => "Delete user failed", "fieldsRequired" => ["id"]);
		}
		$service = new DeleteService();
		$result = $service->execute($id);
		return $result;
	}
}
