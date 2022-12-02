<?php
class RegisterQuestionController
{
	public function __construct()
	{
		require_once "services/questions/register.php";
	}
	public function handle(array $data)
	{
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
			return array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired);
		}
		$service = new RegisterQuestionService();
		$result = $service->execute($content, $userId, $lessonId, $alternatives);
		return $result;
	}
}
