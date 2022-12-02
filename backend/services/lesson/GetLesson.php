<?php
class GetLessonService
{
  public function __construct()
  {
    require_once "connection.php";
    $this->conn = newConnection();
  }
  public function execute($id)
  {
    $reponse = array();
    $sql = "SELECT * FROM lesson WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
    $reponse["status"] = false;
    $reponse["message"] = "Get lesson failed";
    if ($result) {
      $reponse["status"] = true;
      $reponse["message"] = "Get lesson success";
      $reponse["data"] = $result;
    }
    return $reponse;
  }
}
