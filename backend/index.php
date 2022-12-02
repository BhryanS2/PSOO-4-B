<?php
include_once "controllers/user/LoginController.php";
include_once "controllers/user/SignupController.php";
include_once "controllers/user/DeleteUserController.php";
include_once "controllers/user/GetAllController.php";

include_once "controllers/lessons/GetAllController.php";
include_once "controllers/lessons/GetController.php";
include_once "controllers/lessons/RegisterController.php";
include_once "controllers/lessons/DeleteController.php";

include_once "controllers/questions/DeleteQuestionController.php";
include_once "controllers/questions/GetAllController.php";
include_once "controllers/questions/getQuestionController.php";
include_once "controllers/questions/RegisterQuestionController.php";

include_once "controllers/userAnswer/GetAllController.php";
include_once "controllers/userAnswer/GetController.php";
include_once "controllers/userAnswer/RegisterController.php";

require_once "connection.php";

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
	"lesson-getall" => [
		"GET" => "GetAllLessonsController",
	],
	"lesson" => [
		"GET" => "GetLessonController",
		"DELETE" => "DeleteLessonController",
		"POST" => "RegisterLessonController",
	],
	"question" => [
		"DELETE" => "DeleteQuestionController",
		"GET" => "getQuestionController",
		"POST" => "RegisterQuestionController",
	],
	"question-getall" => [
		"GET" => "GetAllQuestionsController",
	],
	"answer" => [
		"POST" => "SendAnserController",
		"GET" => "GetAnserController",
	],
	"answer-getall" => [
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
// }

// main();

//  php -S localhost:3000
