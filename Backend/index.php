<?php
require "controllers/user/LoginController.php";
require "controllers/user/SignupController.php";
require "controllers/user/DeleteUserController.php";
require "controllers/user/GetAllController.php";

require "controllers/lessons/GetAllController.php";
require "controllers/lessons/GetController.php";
require "controllers/lessons/RegisterController.php";
require "controllers/lessons/DeleteController.php";

require "controllers/questions/DeleteQuestionController.php";
require "controllers/questions/GetAllController.php";
require "controllers/questions/getQuestionController.php";
require "controllers/questions/RegisterQuestionController.php";

require "controllers/userAnswer/GetAllController.php";
require "controllers/userAnswer/GetController.php";
require "controllers/userAnswer/RegisterController.php";


$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = explode("?", $uri)[0];
$uri = explode("/", $uri);
$uri = array_filter($uri);
$uri = array_values($uri);
$uri = implode("/", $uri);

$routes = [
	"login" => [
		"POST" => "LoginController",
	],
	"signup" => [
		"POST" => "SignupController",
	],
	"delete" => [
		"DELETE" => "DeleteUserController",
	],
	"getall" => [
		"GET" => "GetAllController",
	],
	"lesson/getall" => [
		"GET" => "GetAllLessonsController",
	],
	"lesson" => [
		"/getall" => [
			"GET" => "GetAllLessonsController",
		],
		"GET" => "GetLessonController",
		"DELETE" => "DeleteLessonController",
		"POST" => "RegisterLessonController",
	],
	"question" => [
		"DELETE" => "DeleteQuestionController",
		"GET" => "getQuestionController",
		"POST" => "RegisterQuestionController",
	],
	"question/getall" => [
		"GET" => "GetAllQuestionsController",
	],
	"answer" => [
		"POST" => "SendAnserController",
		"GET" => "GetAnserController",
	],
	"answer/getall" => [
		"GET" => "GetAllAnswersController",
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
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");
	header("HTTP/2 200 OK");

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

//  php -S localhost:3000
