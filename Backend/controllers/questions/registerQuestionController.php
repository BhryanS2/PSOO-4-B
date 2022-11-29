<?php
class RegisterQuestionController
{
	public function __construct()
	{
		require_once "services/questions/register.php";
	}
	public function handle()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		$content = isset($data['content']) ? $data['content'] : null;
		$userId = isset($data['userId']) ? $data['userId'] : null;
		$lessonId = isset($data['lessonId']) ? $data['lessonId'] : null;
		$alternatives = isset($data['alternatives']) ? $data['alternatives'] : null;

		if ($content === null || $userId === null || $lessonId === null || $alternatives === null) {
			$fieldsRequired = array();
			if ($content == null) {
				array_push($fieldsRequired, "content");
			}
			if ($userId == null) {
				array_push($fieldsRequired, "userId");
			}
			if ($lessonId == null) {
				array_push($fieldsRequired, "lessonId");
			}
			if ($alternatives == null) {
				array_push($fieldsRequired, "alternatives");
			}
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired));
			return;
		}
		$service = new RegisterQuestionService();
		$result = $service->execute($content, $userId, $lessonId, $alternatives);
		echo json_encode($result);
		return json_encode($result);
		return json_encode($result);
	}
}
