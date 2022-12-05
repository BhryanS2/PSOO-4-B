<?php
class GetBlocoService
{

  private Database $conn;
  private Response $response;

  public function __construct()
  {
    include_once "connection.php";
    include_once "utils/responsePattern.php";
    $this->conn = new Database();
    $this->response = new Response(false, "Get bloco failed");
  }

  public function execute($id)
  {
    $sql = "SELECT * FROM blocos WHERE id = :id";
    $params = array(
      ":id" => $id
    );
    $result = $this->conn->select($sql, $params);
    $this->response->setSqlError($this->conn->getErrorInfo());

    if ($result) {
      $this->response->setAll(true, "Get bloco success", $result);
    }

    return $this->response->getResponse();
  }
}
