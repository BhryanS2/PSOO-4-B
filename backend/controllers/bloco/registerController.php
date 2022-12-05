<?php
class RegisterBlocoController
{
	public function __construct()
	{
		require_once "services/bloco/register.php";
	}
	public function handle()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		$name = isset($data['name']) ? $data['name'] : null;
		$pisos = isset($data['pisos']) ? $data['pisos'] : null;
		$quartos = isset($data['quartos']) ? $data['quartos'] : null;

		if ($name === null || $pisos === null || $quartos === null) {
			$fieldsRequired = array();
			if ($name == null) {
				array_push($fieldsRequired, "name");
			}
			if ($pisos == null) {
				array_push($fieldsRequired, "pisos");
			}
			if ($quartos == null) {
				array_push($fieldsRequired, "quartos");
				array_push($fieldsRequired, "** Deve ser enviado quantos quartos tem em cada piso **");
			}
			http_response_code(400);
			echo json_encode(array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired));
			return;
		}
		$service = new RegisterBlocoService();
		$result = $service->execute($name, $pisos, $quartos);
		echo json_encode($result);
		return $result;
	}
}
