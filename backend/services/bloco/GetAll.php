<?php


include_once "connection.php";
include_once "utils/responsePattern.php";

class GetAllBlocosService
{
	private Database $conn;
	private Response $response;

	public function __construct()
	{
		$this->conn = new Database();
		$this->response = new Response(false, "Get all blocos failed");
	}

	public function execute()
	{
		$sql = "SELECT * FROM blocos";
		$result = $this->conn->select($sql);

		$this->response->setSqlError($this->conn->getErrorInfo());

		if (count($result) > 0) {
			$this->response->setAll(true, "Get all blocos success", $result);
		}
		return $this->response->getResponse();
	}
}
