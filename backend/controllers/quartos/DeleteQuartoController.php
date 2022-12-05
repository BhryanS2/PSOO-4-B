<?php
class DeleteQuartoController
{
  public function __construct()
  {
    require_once "services/quartos/Delete.php";
  }
  public function handle()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
      return array("status" => false, "message" => "Delete failed", "fieldsRequired" => ["id"]);
    }

    $service = new DeleteService();
    $result = $service->execute($id);
    return $result;
  }
}