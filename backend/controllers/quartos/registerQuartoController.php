<?php
class RegisterQuartoController
{
	public function __construct()
	{
		require_once "services/quartos/register.php";
	}
	public function handle()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		$name = isset($data['name']) ? $data['name'] : null;
		$piso = isset($data['piso']) ? $data['piso'] : null;
		$leitos = isset($data['leitos']) ? $data['leitos'] : null;
		$blocoId = isset($data['blocoId']) ? $data['blocoId'] : null;


		if ($name === null || $piso === null || $leitos === null || $blocoId === null) {
			$fieldsRequired = array();
			if ($name == null) {
				array_push($fieldsRequired, "name");
			}
			if ($piso == null) {
				array_push($fieldsRequired, "piso");
			}
			if ($leitos == null) {
				array_push($fieldsRequired, "leitos");
			}
			if ($blocoId == null) {
				array_push($fieldsRequired, "blocoId");
			}

			return array("status" => false, "message" => "Register failed", "fieldsRequired" => $fieldsRequired);
		}
		$service = new RegisterQuartoService();
		$result = $service->execute($name, $piso, $leitos, $blocoId);
		return $result;
	}
}
