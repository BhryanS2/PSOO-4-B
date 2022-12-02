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
		$filters = array();
		foreach ($filtersAccepted as $filter) {
			if (isset($data[$filter])) {
				$filters[$filter] = $data[$filter];
			}
		}
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
