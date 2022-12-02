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


		return array(
			"status" => false,
			"message" => "Get all questions failed",
			"filters_accepted" => $filtersAccepted,
			"filters" => $filters
		);

		$service = new GetAllQuestionsService();
		$result = $service->execute($filters);
		$result = array(
			...$result,
			"filters_accepted" => $filtersAccepted,
			"filters" => $filters
		);
		return $result;
	}
}
