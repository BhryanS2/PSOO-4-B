<?php
include_once 'conexao.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
function getData()
{
	global $conn, $id;
	$sql_lessons = "SELECT * from lesson";
	$sql = "SELECT * FROM questions
		inner join lesson on lesson.id = questions.lesson_id
		WHERE questions.id = $id";
	$result = $conn->query($sql);
	$questao = null;
	$questao = $result->fetch_all(MYSQLI_ASSOC);

	$lessons = $conn->query($sql_lessons);
	$lessons = $lessons->fetch_all(MYSQLI_ASSOC);

	return [$questao, $lessons];
}

[$questao, $lessons] = getData();

// save

$data = $_POST;

if (isset($data['content']) && isset($data['explanation']) && isset($data['lesson'])) {
	$content = $data['content'];
	$explanation = $data['explanation'];
	$lesson = $data['lesson'];
	$sql_update = "UPDATE questions SET content = '$content', explanation = '$explanation', lesson_id = $lesson WHERE id = $id";
	$conn->query($sql_update);
	[$questao, $lessons] = getData();
}

?>

<form action="#" method="POST">
	<?php
	foreach ($questao as $q) :
	?>
		<div>
			<label for="lesson">Matéria</label>

			<select name="lesson">
				<?php foreach ($lessons as $lesson) : ?>
					<?php if ($lesson['id'] == $q['lesson_id']) {
						$option_selected = "selected";
					} else {
						$option_selected = "";
					} ?>
					<option <?= $option_selected ?> value="<?= $lesson['id'] ?>"><?= $lesson['name'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			<label for="content">Conteúdo</label>

			<textarea name="content">
					<?= $q['content'] ?>
				</textarea>
		</div>

		<div>

			<label for="explanation">Explicação</label>
			<textarea name="explanation">
					<?= $q['explanation'] ?>
				</textarea>
		</div>

		<div>
			<label for="alternatives">Alternativas</label>
			<?php
			$sql_alternatives = "SELECT * FROM alternatives WHERE question_id = $id";
			$alternatives = $conn->query($sql_alternatives);
			$alternatives = $alternatives->fetch_all(MYSQLI_ASSOC);
			$charcode = "A";
			foreach ($alternatives as $alternative) :
			?>
				<div>
					<label for="alternatives[]">
						<?= $charcode ?>
					</label>
					<input type="text" name="alternatives[]" value="<?= $alternative['content'] ?>">
				</div>
			<?php
				$charcode++;
			endforeach;
			?>
		</div>

	<?php endforeach; ?>
	<button type="submit">Salvar</button>
</form>
