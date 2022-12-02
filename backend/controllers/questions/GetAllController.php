<?php
class GetAllQuestionsController
{
	public function __construct()
	{
		require "services/questions/GetAllService.php";
	}
	public function handle()
	{
		$filtersAccepted = [
			"id",
			"content",
			"content",
			"lessonId",
			"userId"
		];
		// $filters = array_intersect_key($data, array_flip($filtersAccepted));

		$service = new GetAllQuestionsService();
		$result = $service->execute();

		return $result;
	}
}
