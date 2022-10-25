<?php
class DeleteUserController
{
  public function __construct()
  {
    require_once "services/user/Delete.php";
  }
  public function handle()
  {

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $id = isset($data['id']) ? $data['id'] : null;
    if (!$id) {
      http_response_code(400);
      echo json_encode(array("status" => false, "message" => "Delete failed", "fieldsRequired" => ["id"]));
      return;
    }

    $service = new DeleteService();
    $result = $service->execute($id);
    echo json_encode($result);
    return;
  }
}
