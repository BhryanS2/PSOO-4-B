<?php
class GetAllQuartosController
{
  public function __construct()
  {
    require "services/quartos/GetAllService.php";
  }
  public function handle()
  {
    $service = new GetAllService();
    $result = $service->execute();
    echo json_encode($result);
    return;
  }
}
