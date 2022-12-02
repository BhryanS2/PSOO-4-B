<?php
class GetAllQuestionsController
{
	public function __construct()
	{
		require "services/questions/GetAllService.php";
	}
	public function handle(array $data)
	{
		$filtersAccepted = [
			"id",
			"content",
			"content",
			"lessonId",
			"userId"
		];
		$filters = array_intersect_key($data, array_flip($filtersAccepted));

		$service = new GetAllQuestionsService();
		$result = $service->execute($filters);

		if (count($result) > 0) {
			return $result;
		}

		return array(
			"status" => false,
			"message" => "No questions found"
		);
	}
}
