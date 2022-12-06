<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Questão</title>
</head>

<body>
	<?php
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	if (!$id) {
		include_once "save.php";
	} else {
		include_once "edit.php";
	}
	?>
	<a href="../admin.php">Voltar</a>
</body>

</html>
