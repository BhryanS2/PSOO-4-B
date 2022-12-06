<?php
include_once "conexao.php";
$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
	header('Location: ../admin.php');
}

$sql_delete_question = "DELETE FROM questions WHERE id = '$id'";
$conn->query($sql_delete_question);
header('Location: ../admin.php');
