<?php
class RegisterLessonService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  public function execute($name, $description, $userId)
  {
    $reponse = array();
    $sql = "INSERT INTO lesson (name, description, user_id) VALUES (:name, :description, :user_id)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();
    $reponse["status"] = false;
    $reponse["message"] = "Register lesson failed";
    if ($stmt->rowCount() > 0) {
      $reponse["status"] = true;
      $reponse["message"] = "Register lesson success";
    }
    return $reponse;
  }
}
