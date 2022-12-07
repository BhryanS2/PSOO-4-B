<?php
class GetAllQuestionsService
{
	public function __construct()
	{
		require_once "connection.php";
		$this->conn = newConnection();
	}

	private function toJSON($result)
	{
		$questions = array();
		foreach ($result as $row) {
			$questionId = $row['id'];
			if (!isset($questions[$questionId])) {
				$questions[$questionId] = array(
					"id" => $row['id'],
					"content" => $row['content'],
					"lessonId" => $row['lesson_id'],
					"createdAt" => $row['created_at'],
					"updatedAt" => $row['updated_at'],
					"explanation" => $row['explanation'],
					"alternatives" => array()
				);
			}
			array_push($questions[$questionId]['alternatives'], array(
				"content" => $row['alternative_content'],
				"isCorrect" => $row['isCorrect'],
				"id" => $row['alternative_id']
			));
		}
		return array_values($questions);
	}

	private function filter_questions($questions, $filters)
	{
		$filtered_questions = array();
		foreach ($questions as $question) {
			$add = true;
			foreach ($filters as $key => $value) {
				if ($question[$key] != $value) {
					$add = false;
					break;
				}
			}
			if ($add) {
				array_push($filtered_questions, $question);
			}
		}
		return $filtered_questions;
	}

	public function execute(array $data)
	{

		$response = array(
			"status" => false,
			"message" => "Get all questions failed"
		);


		$sql = "SELECT questions.id,
    questions.content,
    questions.lesson_id,
    questions.created_at,
    questions.updated_at,
		questions.explanation,
    alternatives.content as alternative_content,
    alternatives.isCorrect,
    alternatives.id as alternative_id
    FROM questions
		INNER JOIN alternatives ON questions.id = alternatives.question_id";

		// $array = array(
		// 	"status" => true,
		// 	"message" => "Get all questions success",
		// 	"data" => [
		// 		[
		// 			"id" => 1,
		// 			"content" => "Um segmento de reta está dividido em duas partes na proporção áurea quando o todo está para uma das partes na mesma razão em que essa parte está para a outra. Essa constante de proporcionalidade é comumente representada pela letra grega φ, e seu valor é dado pela solução positiva da equação φ2 = φ + 1. Assim como a potência φ2 , as potências superiores de φ podem ser expressas da forma aφ + b, em que a e b são inteiros positivos, como apresentado no quadro. A potência φ = 7, escrita na forma aφ + b (a e b são inteiros positivos), é",
		// 			"lessonId" => 8,
		// 			"createdAt" => "2022-11-30 08:53:14",
		// 			"updatedAt" => "2022-11-30 08:53:14",
		// 			"explanation" => "Explicação não disponível",
		// 			"alternatives" => [
		// 				[
		// 					"content" => "5φ + 3",
		// 					"isCorrect" => 0,
		// 					"id" => 1
		// 				],
		// 				[
		// 					"content" => "7φ + 2",
		// 					"isCorrect" => 0,
		// 					"id" => 2
		// 				],
		// 				[
		// 					"content" => "9φ + 6",
		// 					"isCorrect" => 0,
		// 					"id" => 3
		// 				],
		// 				[
		// 					"content" => "11φ + 7",
		// 					"isCorrect" => 0,
		// 					"id" => 4
		// 				],
		// 				[
		// 					"content" => "13φ + 8",
		// 					"isCorrect" => 1,
		// 					"id" => 5
		// 				]
		// 			]
		// 		],
		// 		[
		// 			"id" => 2,
		// 			"content" => "A soma dos ângulos internos de um polígono convexo é igual a",
		// 			"lessonId" => 10,
		// 			"createdAt" => "2022-11-30 08:53:14",
		// 			"updatedAt" => "2022-11-30 08:53:14",
		// 			"explanation" => "Explicação não disponível",
		// 			"alternatives" => [
		// 				[
		// 					"content" => "180°",
		// 					"isCorrect" => 0,
		// 					"id" => 6
		// 				],
		// 				[
		// 					"content" => "360°",
		// 					"isCorrect" => 0,
		// 					"id" => 7
		// 				],
		// 				[
		// 					"content" => "540°",
		// 					"isCorrect" => 0,
		// 					"id" => 8
		// 				],
		// 				[
		// 					"content" => "720°",
		// 					"isCorrect" => 1,
		// 					"id" => 9
		// 				],
		// 				[
		// 					"content" => "900°",
		// 					"isCorrect" => 0,
		// 					"id" => 10
		// 				]
		// 			]
		// 		]

		// 	]
		// );
		// return $array;
		$stmt = $this->conn->prepare($sql);
		$result = $stmt->execute();

		if (!$result) {
			$response['error'] = $this->conn->error;
			return $response;
		}


		$result = $stmt->get_result();

		if (!$result) {
			$response['error'] = $this->conn->error;
			return $response;
		}

		$result = $result->fetch_all(MYSQLI_ASSOC);

		if (count($result) <= 0) {
			$response['message'] = "No questions found";
			return $response;
		}

		$questions = $this->toJSON($result);
		if (count($data) > 0) {
			$questions = $this->filter_questions($questions, $data);
		}

		$response['status'] = true;
		$response['message'] = "Get all questions success";
		$response['data'] = $questions;
		return $response;
	}
}
