<?php
class DeleteQuestionController
{
	public function __construct()
	{
		require_once "services/questions/Delete.php";
	}
	public function handle(array $data)
	{
		$id = isset($data['id']) ? $data['id'] : null;
		if (!$id) {
			return array("status" => false, "message" => "Delete failed", "fieldsRequired" => ["id"]);
		}

		$service = new DeleteQuestionService();
		$result = $service->execute($id);
		return $result;
	}
}
