<?php
echo "<h1>PHP</h1>";

require "./backend/connection.php";
require "./backend/controllers/user/GetAllController.php";

?>
<h1>connection</h1>
<?php
print_r($conn);
$sql = "SELECT * FROM `users`";
$statement = $conn->prepare($sql);

$statement->execute();

$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

?>

<h1>users</h1>
<pre>
	<?php
	print_r($users);
	?>
</pre>

<?php
$controller = new GetAllController();
$controller->handle();
?>
