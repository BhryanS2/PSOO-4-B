<?php
class RegisterAlunoController
{
	public function __construct()
	{
		require_once "services/aluno/Register.php";
	}
	public function handle()
	{
		// get data from json body
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		$name = isset($data['name']) ? $data['name'] : null;
		$leitoOcupado = isset($data['leito']) ? $data['leito'] : null;
		$blocoId = isset($data['blocoId']) ? $data['blocoId'] : null;
		$quartoId = isset($data['quartoId']) ? $data['quartoId'] : null;

		if ($name == null || $leitoOcupado == null || $blocoId == null || $quartoId == null) {
			$fieldsRequired = array();
			if ($name == null) {
				array_push($fieldsRequired, "name");
			}
			if ($leitoOcupado == null) {
				array_push($fieldsRequired, "leito");
			}
			if ($blocoId == null) {
				array_push($fieldsRequired, "blocoId");
			}

			if ($quartoId == null) {
				array_push($fieldsRequired, "quartoId");
			}

			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired));
			return;
		}

		$service = new RegisterService();
		$result = $service->execute($name, $leitoOcupado, $blocoId, $quartoId);
		echo json_encode($result);
		return;
	}
}
