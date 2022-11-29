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
			return json_encode(array("status" => false, "message" => "Get lesson failed", "fieldsRequired" => ["id"]));
		}
		$service = new GetLessonService();
		$result = $service->execute($id);
		echo json_encode($result);
		return json_encode($result);
	}
}
