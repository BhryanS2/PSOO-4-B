<?php
class GetAllAnswersController
{
	public function __construct()
	{
		require_once "services/userAnswer/getAll.php";
	}
	public function handle()
	{
		$service = new GetAllAnswersService();
		$result = $service->execute();
		return $result;
	}
}
