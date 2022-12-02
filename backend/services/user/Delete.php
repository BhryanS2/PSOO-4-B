<?php
class DeleteService
{
  public function __construct()
  {
    require_once "connection.php";
    $this->conn = newConnection();
  }
  public function execute($id)
  {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $response["status"] = true;
    $response["message"] = "Delete success";
    return $response;
  }
}
