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
    $sql = "SELECT * FROM quartos";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $reponse["status"] = false;
    $reponse["message"] = "Get all quartos failed";
    if (count($result) > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Get all quartos success";
      $reponse["data"] = $result;
    }
    return $reponse;
  }
}
