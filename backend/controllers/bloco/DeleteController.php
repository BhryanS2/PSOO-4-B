<?php
class DeleteBlocoController
{
  public function __construct()
  {
    include_once "services/bloco/Delete.php";
  }
  public function handle()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
      http_response_code(400);
      echo json_encode(array("status" => false, "message" => "Delete lesson failed", "fieldsinclude_onced" => ["id"]));
      return;
    }
    $service = new DeleteBlocoService();
    $result = $service->execute($id);
    return $result;
  }
}
