<?php
class GetAllLessonService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute()
  {
    $reponse = array();
    $sql = "SELECT id, name, description FROM lesson";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $reponse["status"] = false;
    $reponse["message"] = "Get all lessons failed";
    if (count($result) > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Get all lessons success";
      $reponse["data"] = $result;
    }
    return $reponse;
  }
}
