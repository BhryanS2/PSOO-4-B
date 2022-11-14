<?php
class DeleteBlocoService
{

  private Database $conn;
  private Response $response;

  public function __construct()
  {
    require_once "connection.php";
    require_once "utils/responsePattern.php";
    $this->conn = new Database();
    $this->response = new Response(false, "Delete blocos failed");
  }


  public function execute($id)
  {
    $sql = "DELETE FROM blocos WHERE id = :id";
    $params = array(
      ":id" => $id
    );
    $result = $this->conn->delete($sql, $params);
    $this->response->sqlerror = $this->conn->getErrorInfo();

    if ($result) {
      $this->response->setAll(true, "Delete bloco success");
    }
    return $this->response->getResponse();
  }
}
