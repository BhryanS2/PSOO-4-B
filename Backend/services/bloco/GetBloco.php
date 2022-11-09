<?php
class GetBlocoService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute($id)
  {
    $reponse = array();
    $sql = "SELECT * FROM blocos WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
    $reponse["status"] = false;
    $reponse["message"] = "Get bloco failed";
    if ($result) {
      $reponse["status"] = true;
      $reponse["message"] = "Get bloco success";
      $reponse["data"] = $result;
    }
    return $reponse;
  }
}
