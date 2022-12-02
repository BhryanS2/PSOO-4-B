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
		$filters = array();
		foreach ($filtersAccepted as $filter) {
			if (isset($_GET[$filter])) {
				$filters[$filter] = $_GET[$filter];
			}
		}
		$service = new GetAllQuestionsService();
		$result = $service->execute($filters);
		return $result;
	}
}
