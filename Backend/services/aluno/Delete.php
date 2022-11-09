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
    $sql = "DELETE FROM alunos WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return array("status" => true, "message" => "Delete success");
  }
}
