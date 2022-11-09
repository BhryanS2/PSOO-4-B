<?php
class DeleteBlocoService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute($id)
  {
    $reponse = array();
    $sql = "DELETE FROM blocos WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $reponse["status"] = false;
    $reponse["message"] = "Delete bloco failed";
    if ($stmt->rowCount() > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Delete bloco success";
    }
    return $reponse;
  }
}
