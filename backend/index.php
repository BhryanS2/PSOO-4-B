<?php
include_once "controllers/alunos/DeleteUserController.php";
include_once "controllers/alunos/GetAllController.php";
include_once "controllers/alunos/RegisterController.php";

include_once "controllers/bloco/DeleteController.php";
include_once "controllers/bloco/GetAllController.php";
include_once "controllers/bloco/getController.php";
include_once "controllers/bloco/registerController.php";

include_once "controllers/quartos/DeleteQuartoController.php";
include_once "controllers/quartos/GetAllController.php";
include_once "controllers/quartos/getQuartosController.php";
include_once "controllers/quartos/registerQuartoController.php";

include_once "controllers/getAll.php";

include_once "utils/responsePattern.php";
include_once "connection.php";

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
	"getinfos" => [
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

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");
header("HTTP/2 200 OK");

// global $routes;
$route = isset($_GET['route']) ? $_GET['route'] : '';
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$post = $_POST;
$get = $_GET;

$merge = array_merge($post, $get);

# merge all
if ($input) {
	$merge = array_merge($merge, $input);
}

$data = $merge;
$controller = $route;

// print_r($routes[$controller][$method]);

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
$result = $controller->handle($data);
echo json_encode($result);
