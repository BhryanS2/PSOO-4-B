<?php
class RegisterBlocoService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute($name, $pisos, $quartos)
  {
    $sql = "INSERT INTO blocos (name, pisos, quartos) VALUES (:name, :pisos, :quartos)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":pisos", $pisos);
    $stmt->bindParam(":quartos", $quartos);
    $stmt->execute();
    $response = array();
    $response["status"] = false;
    $response["message"] = "Register bloco failed";
    if ($stmt->rowCount() > 0) {
      $response["status"] = true;
      $response["message"] = "Register bloco success";
    }
    return $response;
  }
}
