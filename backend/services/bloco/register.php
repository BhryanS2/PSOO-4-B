<?php
class RegisterBlocoService
{

  private Database $conn;
  private Response $response;

  public function __construct()
  {
    include_once "connection.php";
    include_once "utils/responsePattern.php";
    $this->conn = new Database();
    $this->response = new Response(false, "Register bloco failed");
  }


  public function execute($name, $pisos, $quartos)
  {
    $sql = "INSERT INTO blocos (name, pisos, quartos) VALUES (:name, :pisos, :quartos)";
    $params = array(
      ":name" => $name,
      ":pisos" => $pisos,
      ":quartos" => $quartos
    );
    $result = $this->conn->insert($sql, $params);
    $this->response->setSqlError($this->conn->getErrorInfo());

    if ($result) {
      $this->response->setAll(true, "Register bloco success");
    }

    return $this->response->getResponse();
  }
}
