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
			$fieldsrequire_onced = array();
			if ($name == null) {
				array_push($fieldsrequire_onced, "name");
			}
			if ($pisos == null) {
				array_push($fieldsrequire_onced, "pisos");
			}
			if ($quartos == null) {
				array_push($fieldsrequire_onced, "quartos");
				array_push($fieldsrequire_onced, "** Deve ser enviado quantos quartos tem em cada piso **");
			}
			return array("status" => false, "message" => "Register failed", "fieldsrequire_onced" => $fieldsrequire_onced);
		}
		$service = new RegisterBlocoService();
		$result = $service->execute($name, $pisos, $quartos);
		return $result;
	}
}
