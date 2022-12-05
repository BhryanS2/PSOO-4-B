<?php
class GetAllController
{
  public function __construct()
  {
    require "services/aluno/GetAllService.php";
  }
  public function handle()
  {
    $service = new GetAllService();
    $result = $service->execute();
    echo json_encode($result);
    return;
  }
}
