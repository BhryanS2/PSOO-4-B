<?php
class GetAnserController
{
	public function __construct()
	{
		require_once "services/userAnswer/get.php";
	}
	public function handle()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if (!$id) {
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Get answer failed", "fieldsRequired" => ["id"]));
			return;
		}
		$service = new GetAnswerService();
		$result = $service->execute($id);
		echo json_encode($result);
		return;
	}
}