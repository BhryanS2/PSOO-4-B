<?php
class GetAllController
{
	public function __construct()
	{
		require "services/user/GetAllService.php";
	}
	public function handle()
	{
		$service = new GetAllService();
		$result = $service->execute();
		return $result;
	}
}
