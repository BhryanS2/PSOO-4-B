<?php
class GetBlocoController
{
	public function __construct()
	{
		include_once "services/bloco/GetBloco.php";
	}
	public function handle()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if (!$id) {
			return array("status" => false, "message" => "Get lesson failed", "fieldsinclude_onced" => ["id"]);
		}
		$service = new GetBlocoService();
		$result = $service->execute($id);
		return $result;
	}
}
