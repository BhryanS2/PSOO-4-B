<?php
class GetQuartoController
{
	public function __construct()
	{
		require "services/quartos/getQuarto.php";
	}
	public function handle()
	{
		// get id from /quartos/:id
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if (!$id) {
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Get quarto failed", "fieldsRequired" => ["id"]));
			return;
		}

		$service = new GetQuartoService();
		$result = $service->execute($id);
		echo json_encode($result);
		return;
	}
}
