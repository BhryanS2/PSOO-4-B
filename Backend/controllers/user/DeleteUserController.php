<?php
class DeleteUserController
{
  public function __construct()
  {
    require_once "services/user/Delete.php";
  }
  public function handle()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
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
