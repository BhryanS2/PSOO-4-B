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
