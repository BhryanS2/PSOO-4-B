<?php
class GetAllInfos
{
	private Database $conn;
	private Response $response;

	public function __construct()
	{
		include_once "connection.php";
		include_once "utils/responsePattern.php";
		$this->conn = new Database();
		$this->response = new Response(false, "Get all infos failed");
	}

	public function execute()
	{
		$sql_blocos = "SELECT * FROM blocos";
		$sql_quartos = "SELECT * FROM quartos";
		$sql_alunos = "SELECT * FROM alunos";

		$blocos = $this->conn->select($sql_blocos);
		$quartos = $this->conn->select($sql_quartos);
		$alunos = $this->conn->select($sql_alunos);

		$result = array();

		foreach ($blocos as $bloco) {
			$blocoId = $bloco["id"];
			$bloco["quartos"] = array();
			foreach ($quartos as $quarto) {
				$quartoId = $quarto["id"];
				$quarto["alunos"] = array();
				if ($quarto["blocoId"] === $blocoId) {
					foreach ($alunos as $aluno) {
						if ($aluno["quartoId"] === $quartoId) {
							array_push($quarto["alunos"], $aluno);
						}
					}
					array_push($bloco["quartos"], $quarto);
				}
			}
			array_push($result, $bloco);
		}


		if (count($result) > 0) {
			$this->response->setAll(true, "Get all infos success", $result);
		}
		return $this->response->getResponse();
	}
}
