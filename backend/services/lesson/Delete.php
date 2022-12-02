<?php
class DeleteLessonService
{
  public function __construct()
  {
    require_once "connection.php";
    $this->conn = $conn;
  }
  public function execute($id)
  {
    $reponse = array();
    $sql = "DELETE FROM lesson WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $reponse["status"] = false;
    $reponse["message"] = "Delete lesson failed";
    if ($stmt->rowCount() > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Delete lesson success";
    }
    return $reponse;
  }
}
