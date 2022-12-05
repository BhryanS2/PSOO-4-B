<?php
class GetAllController
{
  public function __construct()
  {
    include_once "services/aluno/GetAllService.php";
  }
  public function handle()
  {
    $service = new GetAllService();
    $result = $service->execute();
    return $result;
  }
}
