<?php
class SendAnserController
{
	public function __construct()
	{
		require_once "services/userAnswer/send.php";
	}
	public function handle()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		$userId = isset($data['userId']) ? $data['userId'] : null;
		$questionId = isset($data['questionId']) ? $data['questionId'] : null;
		$alternativeId = isset($data['alternativeId']) ? $data['alternativeId'] : null;

		if ($userId === null || $questionId === null || $alternativeId === null) {
			$fieldsRequired = array();
			if ($userId == null) {
				array_push($fieldsRequired, "userId");
			}
			if ($questionId == null) {
				array_push($fieldsRequired, "questionId");
			}
			if ($alternativeId == null) {
				array_push($fieldsRequired, "alternativeId");
			}
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Send answer failed", "fieldsRequired" => $fieldsRequired));
			return;
		}
		$service = new SendAnswerService();
		$result = $service->execute($userId, $questionId, $alternativeId);
		echo json_encode($result);
		return;
	}
}
