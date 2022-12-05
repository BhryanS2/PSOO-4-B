<?php
class GetAllBlocosController
{
  public function __construct()
  {
    include_once "services/bloco/GetAll.php";
  }
  public function handle()
  {
    $service = new GetAllBlocosService();
    $result = $service->execute();
    return $result;
  }
}
