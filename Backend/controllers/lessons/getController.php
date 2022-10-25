<?php
class GetLessonController
{
	public function __construct()
	{
		require "services/lesson/getLesson.php";
	}
	public function handle()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if (!$id) {
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Get lesson failed", "fieldsRequired" => ["id"]));
			return;
		}
		$service = new GetLessonService();
		$result = $service->execute($id);
		return $result;
	}
}
