<?php
class GetAnswerService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute($id)
  {
    $result = array();
    $sql = "SELECT * FROM answers WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result['status'] = true;
    $result['message'] = "Get answer success";
    $result['data'] = $response;
    return $result;
  }
}
