<?php
class GetAllAnswersController
{
  public function __construct()
  {
    require_once "services/userAnswer/getAll.php";
  }
  public function handle()
  {
    $service = new GetAllAnswersService();
    $result = $service->execute();
    echo json_encode($result);
    return json_encode($result);
  }
}
