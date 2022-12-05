<?php

include_once "connection.php";
include_once "utils/responsePattern.php";

class DeleteService
{
	private Database $conn;
	private Response $response;

	public function __construct()
	{
		$this->conn = new Database();
		$this->response = new Response(false, "Delete aluno failed");
	}
	public function execute($id)
	{
		$sql = "DELETE FROM alunos WHERE id = :id";
		$params = array(
			":id" => $id
		);
		$result = $this->conn->delete($sql, $params);

		$this->response->setSqlError($this->conn->getErrorInfo());

		if ($result) {
			$this->response->setAll(true, "Delete aluno success");
		}

		return $this->response->getResponse();
	}
}
