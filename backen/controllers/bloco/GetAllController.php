<?php
class GetAllBlocosController
{
  public function __construct()
  {
    require "services/bloco/GetAll.php";
  }
  public function handle()
  {
    $service = new GetAllBlocosService();
    $result = $service->execute();
    echo json_encode($result);
    return;
  }
}
