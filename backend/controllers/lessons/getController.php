<?php
class GetLessonController
{
	public function __construct()
	{
		require "services/lesson/getLesson.php";
	}
	public function handle(array $data)
	{
		$id = isset($data['id']) ? $data['id'] : null;
		if (!$id) {
			return array("status" => false, "message" => "Get lesson failed", "fieldsRequired" => ["id"]);
		}
		$service = new GetLessonService();
		$result = $service->execute($id);
		return $result;
	}
}
