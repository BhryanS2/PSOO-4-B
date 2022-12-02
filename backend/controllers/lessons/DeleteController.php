<?php
class DeleteLessonController
{
	public function __construct()
	{
		require_once "services/lesson/Delete.php";
	}
	public function handle(array $data)
	{
		$id = isset($data['id']) ? $data['id'] : null;
		if (!$id) {
			return array("status" => false, "message" => "Delete lesson failed", "fieldsRequired" => ["id"]);
		}
		$service = new DeleteLessonService();
		$result = $service->execute($id);
		return $result;
	}
}
