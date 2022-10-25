<?php
class GetAllController
{
  public function __construct()
  {
    require "services/questions/GetAllService.php";
  }
  public function handle()
  {
    $filtersAccepted = ["id", "lesson", "dificulty", "type", "content", "answer", "created_at", "updated_at"];
    $filters = array();
    foreach ($filtersAccepted as $filter) {
      if (isset($_GET[$filter])) {
        $filters[$filter] = $_GET[$filter];
      }
    }
    $service = new GetAllQuestionsService();
    $result = $service->execute($filters);
    echo json_encode($result);
    return;
  }
}
