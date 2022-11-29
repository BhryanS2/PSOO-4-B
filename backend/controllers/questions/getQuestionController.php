<?php
class GetQuestionController
{
	public function __construct()
	{
		require "services/questions/getQuestion.php";
	}
	public function handle()
	{
		// get id from /questions/:id
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if (!$id) {
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Get question failed", "fieldsRequired" => ["id"]));
			return;
		}

		$service = new GetQuestionService();
		$result = $service->execute($id);
		echo json_encode($result);
		return json_encode($result);
		return json_encode($result);
	}
}
