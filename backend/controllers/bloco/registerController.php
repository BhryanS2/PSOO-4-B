<?php
class RegisterBlocoController
{
	public function __construct()
	{
		include_once "services/bloco/register.php";
	}
	public function handle()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		$name = isset($data['name']) ? $data['name'] : null;
		$pisos = isset($data['pisos']) ? $data['pisos'] : null;
		$quartos = isset($data['quartos']) ? $data['quartos'] : null;

		if ($name === null || $pisos === null || $quartos === null) {
			$fieldsinclude_onced = array();
			if ($name == null) {
				array_push($fieldsinclude_onced, "name");
			}
			if ($pisos == null) {
				array_push($fieldsinclude_onced, "pisos");
			}
			if ($quartos == null) {
				array_push($fieldsinclude_onced, "quartos");
				array_push($fieldsinclude_onced, "** Deve ser enviado quantos quartos tem em cada piso **");
			}
			return array("status" => false, "message" => "Register failed", "fieldsinclude_onced" => $fieldsinclude_onced);
		}
		$service = new RegisterBlocoService();
		$result = $service->execute($name, $pisos, $quartos);
		return $result;
	}
}
