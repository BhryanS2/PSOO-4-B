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
		// {"status":true,"message":"Get all questions success","data":[{"id":1,"content":"Um segmento de reta est\u00e1 dividido em duas partes na propor\u00e7\u00e3o \u00e1urea quando o todo est\u00e1 para uma das partes na mesma raz\u00e3o em que essa parte est\u00e1 para a outra. Essa constante de proporcionalidade \u00e9 comumente representada pela letra grega \u03c6, e seu valor \u00e9 dado pela solu\u00e7\u00e3o positiva da equa\u00e7\u00e3o \u03c62 = \u03c6 + 1. Assim como a pot\u00eancia \u03c62 , as pot\u00eancias superiores de \u03c6 podem ser expressas da forma a\u03c6 + b, em que a e b s\u00e3o inteiros positivos, como apresentado no quadro.\r\nA pot\u00eancia \u03c6 = 7, escrita na forma a\u03c6 + b (a e b s\u00e3o inteiros positivos), \u00e9","lessonId":8,"createdAt":"2022-11-30 08:53:14","updatedAt":"2022-11-30 08:53:14","explanation":"Explica\u00e7\u00e3o n\u00e3o dispon\u00edvel","alternatives":[{"content":"5\u03c6 + 3","isCorrect":0,"id":1},{"content":"7\u03c6 + 2","isCorrect":0,"id":2},{"content":"9\u03c6 + 6","isCorrect":0,"id":3},{"content":"11\u03c6 + 7","isCorrect":0,"id":4},{"content":"13\u03c6 + 8","isCorrect":1,"id":5}]},{"id":2,"content":"A soma dos \u00e2ngulos internos de um pol\u00edgono convexo \u00e9 igual a","lessonId":10,"createdAt":"2022-11-30 08:53:14","updatedAt":"2022-11-30 08:53:14","explanation":"Explica\u00e7\u00e3o n\u00e3o dispon\u00edvel","alternatives":[{"content":"180\u00b0","isCorrect":0,"id":6},{"content":"360\u00b0","isCorrect":0,"id":7},{"content":"540\u00b0","isCorrect":0,"id":8},{"content":"720\u00b0","isCorrect":1,"id":9},{"content":"900\u00b0","isCorrect":0,"id":10}]}]}

		$array = array(
			"status" => true,
			"message" => "Get all questions success",
			"data" => [
				[
					"id" => 1,
					"content" => "Um segmento de reta est\u00e1 dividido em duas partes na propor\u00e7\u00e3o \u00e1urea quando o todo est\u00e1 para uma das partes na mesma raz\u00e3o em que essa parte est\u00e1 para a outra. Essa constante de proporcionalidade \u00e9 comumente representada pela letra grega \u03c6, e seu valor \u00e9 dado pela solu\u00e7\u00e3o positiva da equa\u00e7\u00e3o \u03c62 = \u03c6 + 1. Assim como a pot\u00eancia \u03c62 , as pot\u00eancias superiores de \u03c6 podem ser expressas da forma a\u03c6 + b, em que a e b s\u00e3o inteiros positivos, como apresentado no quadro.\r\nA pot\u00eancia \u03c6 = 7, escrita na forma a\u03c6 + b (a e b s\u00e3o inteiros positivos), \u00e9",
					"lessonId" => 8,
					"createdAt" => "2022-11-30 08:53:14",
					"updatedAt" => "2022-11-30 08:53:14",
					"explanation" => "Explica\u00e7\u00e3o n\u00e3o dispon\u00edvel",
					"alternatives" => [
						[
							"content" => "5\u03c6 + 3",
							"isCorrect" => 0,
							"id" => 1
						],
						[
							"content" => "7\u03c6 + 2",
							"isCorrect" => 0,
							"id" => 2
						],
						[
							"content" => "9\u03c6 + 6",
							"isCorrect" => 0,
							"id" => 3
						],
						[
							"content" => "11\u03c6 + 7",
							"isCorrect" => 0,
							"id" => 4
						],
						[
							"content" => "13\u03c6 + 8",
							"isCorrect" => 1,
							"id" => 5
						]
					]
				],
				// {"id":2,"content":"A soma dos \u00e2ngulos internos de um pol\u00edgono convexo \u00e9 igual a","lessonId":10,"createdAt":"2022-11-30 08:53:14","updatedAt":"2022-11-30 08:53:14","explanation":"Explica\u00e7\u00e3o n\u00e3o dispon\u00edvel","alternatives":[{"content":"180\u00b0","isCorrect":0,"id":6},{"content":"360\u00b0","isCorrect":0,"id":7},{"content":"540\u00b0","isCorrect":0,"id":8},{"content":"720\u00b0","isCorrect":1,"id":9},{"content":"900\u00b0","isCorrect":0,"id":10}]}]}
				[
					"id" => 2,
					"content" => "A soma dos \u00e2ngulos internos de um pol\u00edgono convexo \u00e9 igual a",
					"lessonId" => 10,
					"createdAt" => "2022-11-30 08:53:14",
					"updatedAt" => "2022-11-30 08:53:14",
					"explanation" => "Explica\u00e7\u00e3o n\u00e3o dispon\u00edvel",
					"alternatives" => [
						[
							"content" => "180\u00b0",
							"isCorrect" => 0,
							"id" => 6
						],
						[
							"content" => "360\u00b0",
							"isCorrect" => 0,
							"id" => 7
						],
						[
							"content" => "540\u00b0",
							"isCorrect" => 0,
							"id" => 8
						],
						[
							"content" => "720\u00b0",
							"isCorrect" => 1,
							"id" => 9
						],
						[
							"content" => "900\u00b0",
							"isCorrect" => 0,
							"id" => 10
						]
					]
				]

			]
		);
		return $array;
		// echo "sql: $sql <br>";
		// $stmt = $this->conn->prepare($sql);
		// $result = $stmt->execute();

		// if (!$result) {
		// 	$response['error'] = $this->conn->error;
		// 	return $response;
		// }


		// $result = $stmt->get_result();
		// print_r($result);

		// if (!$result) {
		// 	$response['error'] = $this->conn->error;
		// 	return $response;
		// }

		// $result = $result->fetch_all(MYSQLI_ASSOC);
		// print_r($result);
		// echo "<br>";

		// if (count($result) <= 0) {
		// 	$response['message'] = "No questions found";
		// 	return $response;
		// }

		// $questions = $this->toJSON($result);
		// echo "questions: ";
		// print_r($questions);
		// echo "<br>";
		// if (count($data) > 0) {
		// 	$questions = $this->filter_questions($questions, $data);
		// }

		// $response['status'] = true;
		// $response['message'] = "Get all questions success";
		// $response['data'] = $questions;
		// return $response;
	}
}
