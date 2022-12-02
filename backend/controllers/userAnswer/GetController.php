<?php
class GetAnserController
{
	public function __construct()
	{
		require_once "services/userAnswer/get.php";
	}
	public function handle(array $data)
	{
		$id = isset($data['id']) ? $data['id'] : null;
		if (!$id) {
			return array("status" => false, "message" => "Get answer failed", "fieldsRequired" => ["id"]);
		}
		$service = new GetAnswerService();
		$result = $service->execute($id);
		return $result;
	}
}
