<?php
class DeleteAlunoController
{
  public function __construct()
  {
    include_once "services/aluno/Delete.php";
  }
  public function handle()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
      http_response_code(400);
      echo json_encode(array("status" => false, "message" => "Delete failed", "fieldsinclude_onced" => ["id"]));
      return;
    }

    $service = new DeleteService();
    $result = $service->execute($id);
    return $result;
  }
}
