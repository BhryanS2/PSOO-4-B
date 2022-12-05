<?php
class GetAllController
{
  public function __construct()
  {
    require_once "services/aluno/GetAllService.php";
  }
  public function handle()
  {
    $service = new GetAllService();
    $result = $service->execute();
    return $result;
  }
}
