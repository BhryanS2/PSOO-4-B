<?php
class GetAllBlocosService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute()
  {
    $reponse = array();
    $sql = "SELECT * FROM blocos";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $reponse["status"] = false;
    $reponse["message"] = "Get all blocos failed";
    if (count($result) > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Get all blocos success";
      $reponse["data"] = $result;
    }
    return $reponse;
  }
}
