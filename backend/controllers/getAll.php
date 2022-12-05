<?php
class GetAllInfosController
{
  public function __construct()
  {
    require_once "services/getAll.php";
  }
  public function handle()
  {
    $service = new GetAllInfos();
    $result = $service->execute();
    return $result;
  }
}
