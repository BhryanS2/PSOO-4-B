<?php
class RegisterQuartoService
{

  private Database $conn;
  private Response $response;

  public function __construct()
  {
    require_once "connection.php";
    require_once "utils/responsePattern.php";
    $this->conn = new Database();
    $this->response = new Response(false, "Register quarto failed");
  }

  public function execute($name, $piso, $leitos, $blocoId)
  {
    $sql = "INSERT INTO quartos (name, piso, leitos, blocoId) VALUES (:name, :piso, :leitos, :blocoId)";
    $params = array(
      ":name" => $name,
      ":piso" => $piso,
      ":leitos" => $leitos,
      ":blocoId" => $blocoId
    );
    $result = $this->conn->insert($sql, $params);

    $this->response->setSqlError($this->conn->getErrorInfo());

    if ($result) {
      $this->response->setAll(true, "Register quarto success");
    }

    return $this->response->getResponse();
  }
}
