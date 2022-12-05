<?php
class GetQuartoController
{
	public function __construct()
	{
		include_once "services/quartos/getQuarto.php";
	}
	public function handle()
	{
		// get id from /quartos/:id
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if (!$id) {
			return array("status" => false, "message" => "Get quarto failed", "fieldsinclude_onced" => ["id"]);
		}

		$service = new GetQuartoService();
		$result = $service->execute($id);
		return $result;
	}
}
