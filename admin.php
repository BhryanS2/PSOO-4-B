<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
</head>

<body>
	<script>
		const user = localStorage.getItem('user');
		console.log(user);
		if (!user) {
			window.location.href = 'index.html';
		}
		const userObj = JSON.parse(user);
		if (userObj['role'] !== 'admin') {
			window.location.href = 'index.html';
		}

		function logout() {
			localStorage.removeItem('user');
			window.location.href = 'index.html';
		}
	</script>
	<h1>Admin</h1>
	<button onclick="logout()">Sair</button>
	<?php
	// conexão
	include_once 'conexao.php';
	?>

	<?php

	// listar questões
	$sql = "SELECT
	questions.id,
	questions.content,
	lesson.name as name,
	questions.explanation

	FROM questions
	inner join lesson on lesson.id = questions.lesson_id";
	$result = $conn->query($sql);
	$questoes = [];
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$questoes[] = $row;
		}
	}
	?>

	<h2>Todas questões</h2>

	<div>
		<h2>Cadastro de questão</h2>
		<form action="./saveQuestion.php" method="post">
			<div>
				<label for="content">Enunciado</label>
				<textarea type="text" name="content" id="content">
				</textarea>
			</div>
			<div>
				<label for="lesson_id">Aula</label>
				<select name="lesson_id" id="lesson_id">
					<?php
					$sql = "SELECT * FROM lesson";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
						}
					}
					?>
				</select>
			</div>
			<div>
				<label for="explanation">Explicação</label>
				<input type="text" name="explanation" id="explanation">
			</div>
			<div>
				<h3>Alternativas</h3>
				<div>
					<label for="alternative1">A</label>
					<input type="text" name="alternative1" id="alternative1">
				</div>
				<div>
					<label for="alternative2">B</label>
					<input type="text" name="alternative2" id="alternative2">
				</div>
				<div>
					<label for="alternative3">C</label>
					<input type="text" name="alternative3" id="alternative3">
				</div>

				<div>
					<label for="alternative4">D</label>
					<input type="text" name="alternative4" id="alternative4">
				</div>

				<div>
					<label for="alternative5">E</label>
					<input type="text" name="alternative5" id="alternative5">
				</div>
			</div>
			<div>
				<h3>Qual a correta?</h3>
				<div>
					<label for="correct">A</label>
					<input type="radio" name="correct" id="correct" value="1">
				</div>
				<div>
					<label for="correct">B</label>
					<input type="radio" name="correct" id="correct" value="2">
				</div>
				<div>
					<label for="correct">C</label>
					<input type="radio" name="correct" id="correct" value="3">
				</div>
				<div>
					<label for="correct">D</label>
					<input type="radio" name="correct" id="correct" value="4">
				</div>
				<div>
					<label for="correct">E</label>
					<input type="radio" name="correct" id="correct" value="5">
				</div>
			</div>
			<button type="submit">Salvar</button>
		</form>
	</div>

	<ul>
		<?php foreach ($questoes as $questao) : ?>
			<li>
				<div>
					Questão de <?php echo $questao['name']; ?>
				</div>
				<div>
					<h3>
						<?php echo $questao['content']; ?>
					</h3>
					<span>
						<?php echo $questao['explanation']; ?>
					</span>
				</div>
				<div>
					<a href="./php/addLesson.php?id=<?= $questao['id'] ?>">Editar questão</a>
					<a href="./php/delete.php?id=<?= $questao['id'] ?>">Deletar questão</a>
				</div>

			</li>
		<?php endforeach; ?>
	</ul>



</body>

</html>
