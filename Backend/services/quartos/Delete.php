<?php
class DeleteService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute($id)
  {
    $reponse = array();
    $sql = "DELETE FROM quartos WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $reponse["status"] = false;
    $reponse["message"] = "Delete quarto failed";
    if ($stmt->rowCount() > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Delete quarto success";
    }
    return $reponse;
  }
}
