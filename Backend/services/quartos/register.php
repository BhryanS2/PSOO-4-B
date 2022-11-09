<?php
class RegisterQuartoService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute($name, $piso, $leitos, $blocoId)
  {
    $sql = "INSERT INTO quartos (name, piso, leitos, blocoId) VALUES (:name, :piso, :leitos, :blocoId)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":pisos", $piso);
    $stmt->bindParam(":leitos", $leitos);
    $stmt->bindParam(":blocoId", $blocoId);
    $stmt->execute();
    $response = array();
    $response["status"] = false;
    $response["message"] = "Register quarto failed";
    if ($stmt->rowCount() > 0) {
      $response["status"] = true;
      $response["message"] = "Register quarto success";
    }
    return $response;
  }
}
