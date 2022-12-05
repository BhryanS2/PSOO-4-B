<?php
class GetBlocoController
{
	public function __construct()
	{
		require "services/bloco/GetBloco.php";
	}
	public function handle()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if (!$id) {
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Get lesson failed", "fieldsRequired" => ["id"]));
			return;
		}
		$service = new GetBlocoService();
		$result = $service->execute($id);
		echo json_encode($result);
		return $result;
	}
}
