<?php
// server controller, get and post data

require "controllers/user/LoginController.php";
require "controllers/user/SignupController.php";
require "controllers/user/DeleteUserController.php";
require "controllers/user/GetAllController.php";

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = explode("?", $uri)[0];
$uri = explode("/", $uri);
$uri = array_filter($uri);
$uri = array_values($uri);

$routes = [
  "login" => [
    "POST" => "LoginController",
  ],
  "signup" => [
    "POST" => "SignupController",
  ],
  "delete" => [
    "POST" => "DeleteUserController",
  ],
  "getall" => [
    "GET" => "GetAllController",
  ],
];

function return404()
{
  http_response_code(404);
  echo json_encode(array("status" => false, "message" => "404 Not Found"));
}

function return405($method = "GET")
{
  http_response_code(405);
  echo json_encode(array("status" => false, "message" => "Error 405, $method method not allowed"));
}

function main()
{
  global $method, $uri, $routes;
  if (count($uri) == 0) {
    return404();
    return;
  }
  $controller = $uri[0];
  if (!array_key_exists($controller, $routes)) {
    return404();
    return;
  }
  $controller = $routes[$controller];
  if (!array_key_exists($method, $controller)) {
    return405($method);
    return;
  }
  $controller = $controller[$method];
  $controller = new $controller();
  $controller->handle();
}

main();
