<?php
class GetAllLessonsController
{
  public function __construct()
  {
    require "services/lesson/GetAllService.php";
  }
  public function handle()
  {
    $service = new GetAllLessonService();
    $result = $service->execute();
    echo json_encode($result);
    return;
  }
}
