<?php
class GetAllQuestionsService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }
  public function execute($filters = [])
  {
    $reponse = array();
    $sql = "SELECT * FROM questions";
    $where = "";
    $params = array();
    if (count($filters) > 0) {
      $where = " WHERE ";
      foreach ($filters as $key => $value) {
        $where .= $key . " = :" . $key . " AND ";
        $params[$key] = $value;
      }
      $where = substr($where, 0, -4);
    }
    $sql .= $where;
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    $reponse["status"] = false;
    $reponse["message"] = "Get all questions failed";
    if (count($result) > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Get all questions success";
      $reponse["data"] = $result;
    }
    return $reponse;
  }
}
