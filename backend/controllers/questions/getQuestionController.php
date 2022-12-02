<?php
class GetQuestionController
{
	public function __construct()
	{
		require "services/questions/getQuestion.php";
	}
	public function handle(array $data)
	{
		$id = isset($data['id']) ? $data['id'] : null;
		if (!$id) {
			return array("status" => false, "message" => "Get question failed", "fieldsRequired" => ["id"]);
		}

		$service = new GetQuestionService();
		$result = $service->execute($id);
		return $result;
	}
}
