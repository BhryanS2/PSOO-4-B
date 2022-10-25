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
		$tags = isset($data['tags']) ? $data['tags'] : null;
		if ($content === null || $userId === null || $lessonId === null || $tags === null) {
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
			if ($tags == null) {
				array_push($fieldsRequired, "tags");
			}
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired));
			return;
		}
		$service = new RegisterQuestionService();
		$result = $service->execute($content, $userId, $lessonId, $tags);
		return;
	}
}
