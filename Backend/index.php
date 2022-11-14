<?php
require "controllers/alunos/DeleteUserController.php";
require "controllers/alunos/GetAllController.php";
require "controllers/alunos/RegisterController.php";

require "controllers/bloco/DeleteController.php";
require "controllers/bloco/GetAllController.php";
require "controllers/bloco/getController.php";
require "controllers/bloco/registerController.php";

require "controllers/quartos/DeleteQuartoController.php";
require "controllers/quartos/GetAllController.php";
require "controllers/quartos/getQuartosController.php";
require "controllers/quartos/registerQuartoController.php";

require "controllers/getAll.php";

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = explode("?", $uri)[0];
$uri = explode("/", $uri);
$uri = array_filter($uri);
$uri = array_values($uri);
$uri = implode("/", $uri);

$routes = [
  "alunos" => [
    "GET" => "GetAllController"
  ],
  "aluno" => [
    "POST" => "RegisterAlunoController",
    "DELETE" => "DeleteAlunoController"
  ],
  "blocos" => [
    "GET" => "GetAllBlocosController"
  ],
  "bloco" => [
    "GET" => "GetBlocoController",
    "POST" => "RegisterBlocoController",
    "DELETE" => "DeleteBlocoController"
  ],
  "quartos" => [
    "GET" => "GetAllQuartosController"
  ],
  "quarto" => [
    "GET" => "GetQuartoController",
    "POST" => "RegisterQuartoController",
    "DELETE" => "DeleteQuartoController"
  ],
  "getInfos" => [
    "GET" => "GetAllInfosController"
  ]
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
  $controller = $uri;
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
