<?php
include_once 'conexao.php';
$lessons_sql = "SELECT * from lesson";
$lessons = $conn->query($lessons_sql);
$lessons = $lessons->fetch_all(MYSQLI_ASSOC);

?>

<form action="#" method="POST">
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
			</textarea>
	</div>

	<div>

		<label for="explanation">Explicação</label>
		<textarea name="explanation">
				</textarea>
	</div>

	<div>
		<label for="alternatives">Alternativas</label>
		<?php
		$size = 4;

		$charcode = "A";
		for ($i = 0; $i < $size; $i++) :
		?>
			<div>
				<label for="alternatives[]">
					<?= $charcode ?>
				</label>
				<input type="text" name="alternatives[]">
			</div>
		<?php
			$charcode++;
		endfor;
		?>
	</div>
	<button type="submit">Salvar</button>
</form>

<?php
// submit
$data = $_POST;
$lesson_id = isset($data['lesson']) ? $data['lesson'] : null;
$content = isset($data['content']) ? $data['content'] : null;
$explanation = isset($data['explanation']) ? $data['explanation'] : null;
$alternatives = isset($data['alternatives']) ? $data['alternatives'] : null;

if ($lesson_id && $content && $explanation && $alternatives) {
	$sql = "INSERT INTO questions (lesson_id, content, explanation) VALUES ($lesson_id, '$content', '$explanation')";
	$conn->query($sql);
	$question_id = $conn->insert_id;
	foreach ($alternatives as $alternative) {
		$sql = "INSERT INTO alternatives (question_id, content) VALUES ($question_id, '$alternative')";
		$conn->query($sql);
	}
}
