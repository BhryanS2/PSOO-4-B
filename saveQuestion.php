
<?php
// conexão
include_once 'conexao.php';
?>


<?php

$dados = $_POST;

// <div>
// 		<h2>Cadastro de questão</h2>
// 		<form action="./saveQuestion.php" method="post">
// 			<div>
// 				<label for="content">Enunciado</label>
// 				<textarea type="text" name="content" id="content">
// 				</textarea>
// 			</div>
// 			<div>
// 				<label for="lesson_id">Aula</label>
// 				<select name="lesson_id" id="lesson_id">
// 					<?php
// 					$sql = "SELECT * FROM lesson";
// 					$result = $conn->query($sql);
// 					if ($result->num_rows > 0) {
// 						while ($row = $result->fetch_assoc()) {
// 							echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
// 						}
// 					}
//
// 				</select>
// 			</div>
// 			<div>
// 				<label for="explanation">Explicação</label>
// 				<input type="text" name="explanation" id="explanation">
// 			</div>
// 			<div>
// 				<h3>Alternativas</h3>
// 				<div>
// 					<label for="alternative1">A</label>
// 					<input type="text" name="alternative1" id="alternative1">
// 				</div>
// 				<div>
// 					<label for="alternative2">B</label>
// 					<input type="text" name="alternative2" id="alternative2">
// 				</div>
// 				<div>
// 					<label for="alternative3">C</label>
// 					<input type="text" name="alternative3" id="alternative3">
// 				</div>

// 				<div>
// 					<label for="alternative4">D</label>
// 					<input type="text" name="alternative4" id="alternative4">
// 				</div>

// 				<div>
// 					<label for="alternative5">E</label>
// 					<input type="text" name="alternative5" id="alternative5">
// 				</div>
// 			</div>
// 			<div>
// 				<h3>Qual a correta?</h3>
// 				<div>
// 					<label for="correct">A</label>
// 					<input type="radio" name="correct" id="correct" value="1">
// 				</div>
// 				<div>
// 					<label for="correct">B</label>
// 					<input type="radio" name="correct" id="correct" value="2">
// 				</div>
// 				<div>
// 					<label for="correct">C</label>
// 					<input type="radio" name="correct" id="correct" value="3">
// 				</div>
// 				<div>
// 					<label for="correct">D</label>
// 					<input type="radio" name="correct" id="correct" value="4">
// 				</div>
// 				<div>
// 					<label for="correct">E</label>
// 					<input type="radio" name="correct" id="correct" value="5">
// 				</div>
// 			</div>
// 			<button type="submit">Salvar</button>
// 		</form>
// 	</div>

$content = isset($dados['content']) ? $dados['content'] : '';
$lesson_id = isset($dados['lesson_id']) ? $dados['lesson_id'] : '';
$explanation = isset($dados['explanation']) ? $dados['explanation'] : '';
$alternative1 = isset($dados['alternative1']) ? $dados['alternative1'] : '';
$alternative2 = isset($dados['alternative2']) ? $dados['alternative2'] : '';
$alternative3 = isset($dados['alternative3']) ? $dados['alternative3'] : '';
$alternative4 = isset($dados['alternative4']) ? $dados['alternative4'] : '';
$alternative5 = isset($dados['alternative5']) ? $dados['alternative5'] : '';
$correct = isset($dados['correct']) ? $dados['correct'] : '';

$alternatives = [
	"alternative1" => $alternative1,
	"alternative2" => $alternative2,
	"alternative3" => $alternative3,
	"alternative4" => $alternative4,
	"alternative5" => $alternative5,
];

$mapCorrect = [
	'1' => 'alternative1',
	'2' => 'alternative2',
	'3' => 'alternative3',
	'4' => 'alternative4',
	'5' => 'alternative5',
];


$sql = "INSERT INTO questions (content, lesson_id, explanation) VALUES ('$content', '$lesson_id', '$explanation')";
$sql_alternatives = "INSERT INTO alternatives (content, question_id, isCorrect) VALUES ";

$conn = newConnection();
$conn->query($sql);
// get last id
$lastId = $conn->insert_id;

foreach ($mapCorrect as $key => $value) {
	$isCorrect = $key == $correct ? 1 : 0;
	$alternative = $alternatives[$value];
	$sql_alternatives .= "('$alternative', $lastId, $isCorrect),";
}

$sql_alternatives = substr($sql_alternatives, 0, -1);
// print_r($sql_alternatives);

$conn->query($sql_alternatives);

$conn->close();

header('Location: admin.php');
