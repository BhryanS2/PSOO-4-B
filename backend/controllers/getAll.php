<?php
class GetAllInfosController
{
  public function __construct()
  {
    include_once "services/getAll.php";
  }
  public function handle()
  {
    $service = new GetAllInfos();
    $result = $service->execute();
    return $result;
  }
}
