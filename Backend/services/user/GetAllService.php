<?php
class GetAllService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute()
  {
    $reponse = array();
    $sql = "SELECT id, name, email FROM users";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $reponse["status"] = false;
    $reponse["message"] = "Get all users failed";
    if (count($result) > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Get all users success";
      $reponse["data"] = $result;
    }
    return $reponse;
  }
}
