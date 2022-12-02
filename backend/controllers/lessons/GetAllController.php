<?php
class GetAllLessonsController
{
	public function __construct()
	{
		require "services/lesson/GetAll.php";
	}
	public function handle()
	{
		$service = new GetAllLessonService();
		$result = $service->execute();
		return $result;
	}
}
