<?php


include_once "connection.php";
include_once "utils/responsePattern.php";
class GetQuartoService
{

	private Database $conn;
	private Response $response;

	public function __construct()
	{
		$this->conn = new Database();
		$this->response = new Response(false, "Get quarto failed");
	}
	public function execute($id)
	{
		$sql = "SELECT * FROM quartos WHERE id = :id";
		$params = array(
			":id" => $id
		);
		$result = $this->conn->select($sql, $params);

		$this->response->setSqlError($this->conn->getErrorInfo());

		if ($result) {
			$this->response->setAll(true, "Get quarto success", $result);
		}

		return $this->response->getResponse();
	}
}
