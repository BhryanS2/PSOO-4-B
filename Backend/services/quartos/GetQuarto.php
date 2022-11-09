<?php
class GetQuartoService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute($id)
  {
    $reponse = array();
    $sql = "SELECT * FROM quartos WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
    $reponse["status"] = false;
    $reponse["message"] = "Get quarto failed";
    if ($result) {
      $reponse["status"] = true;
      $reponse["message"] = "Get quarto success";
      $reponse["data"] = $result;
    }

    return $reponse;
  }
}
