<?php
class GetAllQuartosController
{
  public function __construct()
  {
    include_once "services/quartos/GetAllService.php";
  }
  public function handle()
  {
    $service = new GetAllService();
    $result = $service->execute();
    return $result;
  }
}
