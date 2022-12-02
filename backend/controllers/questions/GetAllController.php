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
		return array(
			"status" => true,
			"message" => "Get all questions success",
			"data" => 'no data'
		);
		$result = $service->execute($filters);
		$result = array(
			...$result,
			"filters_accepted" => $filtersAccepted,
			"filters" => $filters
		);
		return $result;
	}
}
