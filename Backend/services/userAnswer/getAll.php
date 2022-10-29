<?php
class GetAllAnswersService
{

  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute()
  {
    $result = array();
    $sql = "SELECT * FROM answers";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result['status'] = true;
    $result['message'] = "Get all answers success";
    $result['data'] = $response;
    return $result;
  }
}
